<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $roles = role::all();
        $users = User::with('role')->get();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Membuat user baru
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
            'status' => 'active', // Sesuaikan dengan status yang diinginkan
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the user.
     */
    public function edit(User $user)
    {
        $roles = role::all();
        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the user data in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->role_id = $validatedData['role_id'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role->role_name === 'Admin') {
            if (Auth::user()->id === $user->id) {
                return redirect()->route('users.index')->with('error', 'Anda tidak bisa menghapus diri sendiri.');
            }
            return redirect()->route('users.index')->with('error', 'Anda tidak bisa menghapus admin lain.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
    public function exportExcel()
{
    return Excel::download(new UsersExport, 'users.xlsx');
}
public function exportPDF()
    {
        $users = User::select(
            'id', 'name', 'email', 'tanggal_lahir', 'jenis_kelamin',
            'asal_sekolah', 'nama_ayah', 'nama_ibu', 'nomor_telepon',
            'nomor_telepon_ortu'
        )->get();

        $pdf = Pdf::loadView('users.pdf', compact('users'))
                  ->setPaper('a4', 'landscape'); // Mengatur ukuran kertas A4 dan landscape

        return $pdf->download('users.pdf');
    }
}