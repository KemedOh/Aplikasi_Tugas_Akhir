<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Role;
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
 try {
        // Validasi umum
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',  // Pastikan ada password_confirmation di request
            'role_id' => 'required|exists:roles,id',
        ]);

        // Validasi tambahan jika role adalah Mahasiswa (misalnya role_id == 1)
        if ($request->role_id == 1) {
            // Validasi khusus untuk mahasiswa
            $request->validate([
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'asal_sekolah' => 'required|string|max:255',
                'nomor_telepon' => 'required|string|max:20',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'nomor_telepon_ortu' => 'required|string|max:20',
            ]);

            // Menyesuaikan jenis kelamin menjadi 'L' atau 'P'
            if ($request->has('jenis_kelamin')) {
                $request->merge([
                    'jenis_kelamin' => $request->jenis_kelamin === 'Laki-laki' ? 'L' : 'P'
                ]);
            }
        }

        // Simpan data user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Password di-hash
        $user->role_id = $validatedData['role_id'];

        // Simpan data tambahan jika role adalah mahasiswa
        if ($request->role_id == 1) {
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->jenis_kelamin = $request->jenis_kelamin; // Sudah disesuaikan sebelumnya
            $user->asal_sekolah = $request->asal_sekolah;
            $user->nomor_telepon = $request->nomor_telepon;
            $user->nama_ayah = $request->nama_ayah;
            $user->nama_ibu = $request->nama_ibu;
            $user->nomor_telepon_ortu = $request->nomor_telepon_ortu;
        }

        $user->save();

    return redirect()->route('users.index');

    } catch (\Exception $e) {
        // Gagal menyimpan, redirect kembali dengan pesan error
        return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
    }

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
public function update(Request $request, $id)
{
    // Temukan user berdasarkan ID
    $user = User::findOrFail($id);

    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Validasi email dengan pengecualian untuk email yang sama
        'role_id' => 'required|exists:roles,id', // Validasi role_id harus ada dalam tabel roles
        'asal_sekolah' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'nomor_telepon' => 'required|string|max:15',
        'nama_ayah' => 'required|string|max:255',
        'nama_ibu' => 'required|string|max:255',
        'nomor_telepon_ortu' => 'required|string|max:15',
    ]);

    // Perbarui data pengguna berdasarkan data yang telah divalidasi
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'role_id' => $validatedData['role_id'],
        'asal_sekolah' => $validatedData['asal_sekolah'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'nomor_telepon' => $validatedData['nomor_telepon'],
        'nama_ayah' => $validatedData['nama_ayah'],
        'nama_ibu' => $validatedData['nama_ibu'],
        'nomor_telepon_ortu' => $validatedData['nomor_telepon_ortu'],
    ]);

    // Kembalikan respons JSON dengan pesan sukses
    return response()->json(['message' => 'User berhasil diperbarui']);
}


    /**
     * Remove the user from storage.
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index');

            } catch (\Exception $e) {
                // Gagal menyimpan, redirect kembali dengan pesan error
                return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage())->withInput();
            }
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