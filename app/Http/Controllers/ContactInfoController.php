<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Tampilkan semua contact info
     */
    public function index(Request $request)
    {
        $search     = $request->search;
        $type       = $request->type;
        $sort       = $request->get('sort');
        $direction  = $request->get('direction', 'desc');

        /*
    =========================
    VALIDASI SORT & DIRECTION
    =========================
    */
        $allowedSorts = ['type', 'label', 'value', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'desc';
        }

        // Tentukan kolom value berdasarkan locale
        $valueColumn = app()->getLocale() == 'id'
            ? 'value_id'
            : 'value_en';

        $query = ContactInfo::query();

        /*
    =========================
    SEARCH
    =========================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%")
                    ->orWhere('label', 'like', "%{$search}%")
                    ->orWhere('value_en', 'like', "%{$search}%")
                    ->orWhere('value_id', 'like', "%{$search}%");
            });
        }

        /*
    =========================
    FILTER TYPE
    =========================
    */
        if ($request->filled('type')) {
            $query->whereIn('type', $type);
        }

        /*
    =========================
    SORTING
    =========================
    */
        if ($sort === 'type') {
            $query->orderBy('type', $direction);
        } elseif ($sort === 'label') {
            $query->orderBy('label', $direction);
        } elseif ($sort === 'value') {
            $query->orderBy($valueColumn, $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $direction);
        } else {
            $query->latest();
        }

        $contactInfos = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-info.index', compact(
            'contactInfos',
            'sort',
            'direction'
        ));
    }

    /**
     * Tampilkan form tambah contact info
     */
    public function create()
    {
        $contactInfo = new ContactInfo();
        $types = ContactInfo::types();

        return view('admin.contact-info.create', compact('contactInfo', 'types'));
    }

    /**
     * Simpan contact info baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'      => 'required|string|in:phone,email,address,map_embed,office_name,social_media',
            'label'     => 'nullable|string|max:100',
            'value_id'  => 'required|string',
            'value_en'  => 'required|string',
        ]);

        ContactInfo::create($validated);

        return redirect()->route('contact.info.index')
            ->with('success', 'Contact info berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit contact info
     */
    public function edit(ContactInfo $contactInfo)
    {
        $types = ContactInfo::types();

        return view('admin.contact-info.edit', compact('contactInfo', 'types'));
    }

    /**
     * Update contact info
     */
    public function update(Request $request, ContactInfo $contactInfo)
    {
        $validated = $request->validate([
            'type'      => 'required|string|in:phone,email,address,map_embed,office_name,social_media',
            'label'     => 'nullable|string|max:100',
            'value_id'  => 'required|string',
            'value_en'  => 'required|string',
        ]);

        $contactInfo->update($validated);

        return redirect()->route('contact.info.index')
            ->with('success', 'Contact info berhasil diupdate.');
    }

    /**
     * Hapus contact info
     */
    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return redirect()->route('contact.info.index')
            ->with('success', 'Contact info berhasil dihapus.');
    }

    // USER
    public function contact()
    {
        $phones = ContactInfo::where('type', 'phone')->get();
        $emails = ContactInfo::where('type', 'email')->get();
        $offices = ContactInfo::whereIn('type', [
            'office_name',
            'address',
            'map_embed',
        ])->get()->groupBy('label');

        return view('contact.index', compact('phones', 'emails', 'offices'));
    }

    /**
     * Ambil contact info sesuai locale terakhir
     */
    public function getByType($type)
    {
        $infos = ContactInfo::where('type', $type)->get();

        $locale = app()->getLocale(); // ambil locale terakhir

        // Map ke value sesuai locale
        $result = $infos->map(function ($item) use ($locale) {
            return [
                'id'    => $item->id,
                'label' => $item->label,
                'value' => $item->getValue($locale),
            ];
        });

        return response()->json($result);
    }
}
