<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterMahasiswaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;

class StudentRegistrationController extends Controller
{
    /**
     * Store a newly registered student.
     */
    public function store(RegisterMahasiswaRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending', // Set status to pending for new student registrations
            'must_change_password' => false,
            'lab_id' => null, // Students are not initially assigned to a lab
        ]);

        event(new Registered($user));

        // Assign the 'mahasiswa' role using spatie/laravel-permission
        // $user->assignRole('mahasiswa'); // Uncomment and ensure role exists

        return redirect()->back()->with('success', 'Pendaftaran berhasil. Akun menunggu verifikasi admin/laboran.');
    }
}