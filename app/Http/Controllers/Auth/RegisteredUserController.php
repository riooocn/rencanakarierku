<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $institutions = Institution::orderBy('name')->get();
        return view('auth.register-peserta', compact('institutions'));
    }

    public function createInstansi(): View
    {
        $institutions = Institution::orderBy('name')->get();
        return view('auth.register-instansi', compact('institutions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:peserta,admin'],
            'phone' => ['required', 'string', 'max:20'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
        ]);

        if ($request->filled('new_school')) {
            $institution = Institution::firstOrCreate(['name' => $request->new_school]);
        } else {
            $request->validate(['school_id' => 'required|exists:institutions,id']);
            $institution = Institution::find($request->school_id);
        }

        if ($request->role === 'admin') {
            $adminCount = User::where('institution_id', $institution->id)
                              ->where('role', 'admin')
                              ->count();
            if ($adminCount >= 3) {
                return back()->withErrors(['school_id' => 'Instansi ini sudah mencapai batas maksimal 3 admin.'])->withInput();
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'institution_id' => $institution->id,
            'phone' => $request->phone,
            'grade' => $request->grade ?? null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'is_active' => false,
        ]);

        event(new Registered($user));

        if (!$user->is_active) {
            return redirect('/login')->with('status', 'Pendaftaran berhasil. Akun Anda sedang menunggu verifikasi dari Admin Instansi atau Super Admin.');
        }

        Auth::login($user);

        // Redirect logic based on role
        if ($user->role === 'superadmin') {
            return redirect('/superadmin')->with('success', 'Pendaftaran berhasil!');
        } elseif ($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Pendaftaran berhasil!');
        }

        return redirect('/perjalananku')->with('success', 'Pendaftaran berhasil!');
    }
}
