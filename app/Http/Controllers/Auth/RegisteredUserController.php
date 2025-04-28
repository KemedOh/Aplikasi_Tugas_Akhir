<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $Roles = Role::all(); // Ambil semua Role dari database
    return view('auth.register', compact('Roles'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData['Role_id'] = (int) $request->Role_id;
        // Validasi Umum
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'Role_id' => ['required', 'exists:Roles,id'],
        ];

        // Validasi Tambahan untuk Mahasiswa
        $RoleMahasiswa = Role::where('Role', 'mahasiswa')->first();
        if ($request->Role_id == $RoleMahasiswa->id) {
            $rules['tanggal_lahir'] = ['required', 'date'];
            $rules['jenis_kelamin'] = ['required', 'in:L,P'];
            $rules['asal_sekolah'] = ['required', 'string', 'max:150'];
            $rules['nama_ayah'] = ['required', 'string', 'max:150'];
            $rules['nama_ibu'] = ['required', 'string', 'max:150'];
            $rules['nomor_telepon'] = ['required', 'string', 'max:20'];
            $rules['nomor_telepon_ortu'] = ['required', 'string', 'max:20'];
        }

        $request->validate($rules);

        // Simpan Data User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Role_id' => (int) $request->Role_id,
            'tanggal_lahir' => $request->Role_id == $RoleMahasiswa->id ? $request->tanggal_lahir : null,
            'jenis_kelamin' => $request->Role_id == $RoleMahasiswa->id ? $request->jenis_kelamin : null,
            'asal_sekolah' => $request->Role_id == $RoleMahasiswa->id ? $request->asal_sekolah : null,
            'nama_ayah' => $request->Role_id == $RoleMahasiswa->id ? $request->nama_ayah : null,
            'nama_ibu' => $request->Role_id == $RoleMahasiswa->id ? $request->nama_ibu : null,
            'nomor_telepon' => $request->Role_id == $RoleMahasiswa->id ? $request->nomor_telepon : null,
            'nomor_telepon_ortu' => $request->Role_id == $RoleMahasiswa->id ? $request->nomor_telepon_ortu : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}