<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->search;
        $type       = $request->type;
        $sort       = $request->get('sort');
        $direction  = $request->get('direction', 'desc');

        // daftar kolom yang boleh di sort
        $allowedSorts = ['type', 'label', 'value', 'created_at'];
        // daftar direction
        $allowedDirections = ['asc', 'desc'];

        // cek apakah sort ada di daftar yang diizinkan
        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        // cek direction valid atau tidak
        if (!in_array($direction, $allowedDirections)) {
            $direction = 'desc';
        }

        $valueColumn = app()->getLocale() == 'id'
            ? 'value_id'
            : 'value_en';

        $query = ContactInfo::query();

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%")
                    ->orWhere('label', 'like', "%{$search}%")
                    ->orWhere('value_en', 'like', "%{$search}%")
                    ->orWhere('value_id', 'like', "%{$search}%");
            });
        }

        // FILTER TYPE
        if ($request->filled('type')) {
            $query->whereIn('type', $type);
        }

        // SORTING
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

    public function create()
    {
        $contactInfo = new ContactInfo();
        $types = ContactInfo::types();

        return view('admin.contact-info.create', compact('contactInfo', 'types'));
    }

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

    public function edit(ContactInfo $contactInfo)
    {
        $types = ContactInfo::types();

        return view('admin.contact-info.edit', compact('contactInfo', 'types'));
    }

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

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return redirect()->route('contact.info.index')
            ->with('success', 'Contact info berhasil dihapus.');
    }

    // HALAMAN USER
    public function contact()
    {
        $phones = ContactInfo::where('type', 'phone')->get();
        $emails = ContactInfo::where('type', 'email')->get();

        $offices = ContactInfo::whereIn('type', [
            'office_name',
            'address',
            'map_embed',
        ])
            ->where('label', '!=', 'footer') // data label footer tidak diambil
            ->get()
            ->groupBy('label'); // mengelompokkan data berdasarkan label

        return view('contact.index', compact('phones', 'emails', 'offices'));
    }

    public function getByType($type) // mengambil contact info berdasarkan type
    {
        $infos = ContactInfo::where('type', $type)->get();

        $locale = app()->getLocale(); // ambil locale terakhir

        // Map value sesuai locale
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
