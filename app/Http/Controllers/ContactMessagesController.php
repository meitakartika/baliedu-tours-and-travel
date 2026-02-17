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

        $messages = ContactMessage::with('user')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                        ->orWhere('created_at', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {

            if (in_array('replied', $status)) {
                $query->whereNotNull('replied_at');
            }

            if (in_array('not_replied', $status)) {
                $query->whereNull('replied_at');
            }
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-messages.index', compact('messages'));
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
