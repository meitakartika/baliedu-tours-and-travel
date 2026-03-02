<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort', 'created_at'); // default
        $direction = $request->get('direction', 'desc'); // default

        $allowedSorts = ['first_name', 'last_name', 'email', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'desc';
        }

        $customers = User::customer()
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'sort', 'direction'));
    }

    public function create()
    {
        $countries = config('countries');
        $customer = new User();

        return view('admin.customers.create', compact('countries', 'customer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8|confirmed',
            'phone'          => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
            'date_of_birth'  => 'nullable|date',
            'country'        => 'nullable|string|max:100',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request
                ->file('profile_image')
                ->store('profiles', 'public');
        }

        User::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $customer)
    {
        $countries = config('countries');

        return view('admin.customers.edit', compact('customer', 'countries'));
    }


    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email,' . $customer->id,
            'password'       => 'nullable|min:8|confirmed',
            'phone'          => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
            'date_of_birth'  => 'nullable|date',
            'country'        => 'nullable|string|max:100',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('profile_image')) {

            if ($customer->profile_image) {
                Storage::disk('public')->delete($customer->profile_image);
            }

            $validated['profile_image'] = $request
                ->file('profile_image')
                ->store('profiles', 'public');
        }

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'User berhasil dihapus');
    }
}
