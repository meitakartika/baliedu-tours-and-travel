<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactMessagesController extends Controller
{
    /**
     * Tampilkan semua contact messages (admin)
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'desc');

        /*
    =========================
    VALIDASI SORT
    =========================
    */
        $allowedSorts = ['name', 'date', 'email', 'status'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'desc';
        }

        $query = ContactMessage::with('user')
            ->leftJoin('users', 'contact_messages.user_id', '=', 'users.id')
            ->select('contact_messages.*');

        /*
    =========================
    SEARCH
    =========================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('contact_messages.created_at', 'like', "%{$search}%");
            });
        }

        /*
    =========================
    FILTER STATUS
    =========================
    */
        if ($status) {
            $query->where(function ($q) use ($status) {
                if (in_array('replied', $status)) {
                    $q->orWhereNotNull('contact_messages.replied_at');
                }

                if (in_array('not_replied', $status)) {
                    $q->orWhereNull('contact_messages.replied_at');
                }
            });
        }

        /*
    =========================
    SORTING
    =========================
    */
        if ($sort === 'name') {
            $query->orderBy('users.first_name', $direction);
        } elseif ($sort === 'email') {
            $query->orderBy('users.email', $direction);
        } elseif ($sort === 'status') {
            $query->orderByRaw("contact_messages.replied_at IS NULL " . ($direction === 'asc' ? 'ASC' : 'DESC'));
        } elseif ($sort === 'date') {
            $query->orderBy('contact_messages.created_at', $direction);
        } else {
            $query->latest('contact_messages.created_at');
        }

        $messages = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-messages.index', compact(
            'messages',
            'sort',
            'direction'
        ));
    }

    /**
     * Simpan message dari user (frontend)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:10|max:2000',
        ]);

        $user = Auth::user();

        // ✅ SIMPAN DATABASE
        ContactMessage::create([
            'user_id' => $user->id,
            'message' => $validated['message'],
        ]);

        // ✅ KIRIM EMAIL
        Mail::raw(
            "Nama: {$user->first_name} {$user->last_name}\n" .
                "Email: {$user->email}\n" .
                "Phone: {$user->phone}\n\n" .
                "Pesan:\n{$validated['message']}",
            function ($mail) {
                $mail->to('kartikadewimeita@gmail.com')
                    ->subject('Contact Message');
            }
        );

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    /**
     * Detail message
     */
    public function show(ContactMessage $contactMessage)
    {
        if (!$contactMessage->is_read) {
            $contactMessage->update([
                'is_read' => true
            ]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'reply_message' => 'required|string|min:5|max:2000',
        ]);

        $user = $contactMessage->user;

        Mail::raw(
            "Hello {$user->first_name} {$user->last_name},\n\n" .
                "{$request->reply_message}\n\n" .
                "Best regards,\nCustomer Support Team",
            function ($mail) use ($user) {
                $mail->to($user->email)
                    ->subject('Reply to Your Message')
                    ->replyTo(config('mail.from.address'), config('mail.from.name'));
            }
        );

        $contactMessage->update([
            'reply_message' => $request->reply_message,
            'replied_at' => now(),
            'is_read' => true
        ]);

        return redirect()->route('contact.messages.index')
            ->with('success', 'Reply berhasil dikirim!');
    }

    /**
     * Hapus message
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('contact.messages.index')
            ->with('success', 'Message berhasil dihapus.');
    }
}
