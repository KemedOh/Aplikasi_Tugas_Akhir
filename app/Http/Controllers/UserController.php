<?php

namespace App\Http\Controllers;
use App\Exports\UsersPdfExport;
use Illuminate\Support\Facades\Log;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        // Ambil role user yang sedang login
        $currentRoleId = Auth::user()->role_id;
        $targetRoleId = $request->role_id;

        // Admin hanya bisa buat Mahasiswa
        if ($currentRoleId == 2 && $targetRoleId != 1) {
            return back()->with('error', 'Admin hanya dapat menambahkan Mahasiswa.');
        }

        // Superadmin tidak boleh buat Superadmin
        if ($currentRoleId == 3 && $targetRoleId == 3) {
            return back()->with('error', 'Superadmin tidak dapat menambahkan Superadmin.');
        }
        $currentUserRole = Auth::user()->role_id;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Cegah admin menambah selain mahasiswa
        if ($currentUserRole == 2 && $request->role_id != 1) {
            return back()->with('error', 'Admin hanya dapat menambahkan Mahasiswa.')->withInput();
        }

        // Cegah superadmin menambah superadmin
        if ($currentUserRole == 3 && $request->role_id == 3) {
            return back()->with('error', 'Superadmin tidak dapat menambahkan Superadmin lain.')->withInput();
        }

        // Validasi tambahan jika role Mahasiswa
        if ($request->role_id == 1) {
            $request->validate([
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'asal_sekolah' => 'required|string|max:255',
                'nomor_telepon' => 'required|string|max:20',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'nomor_telepon_ortu' => 'required|string|max:20',
            ]);

            // Konversi jenis kelamin
            $request->merge([
                'jenis_kelamin' => $request->jenis_kelamin === 'Laki-laki' ? 'L' : 'P'
            ]);
        }

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_id = $validatedData['role_id'];

        if ($request->role_id == 1) {
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->asal_sekolah = $request->asal_sekolah;
            $user->nomor_telepon = $request->nomor_telepon;
            $user->nama_ayah = $request->nama_ayah;
            $user->nama_ibu = $request->nama_ibu;
            $user->nomor_telepon_ortu = $request->nomor_telepon_ortu;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data berhasil disimpan!');
    } catch (\Exception $e) {
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
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'role_id' => 'required|integer',
        // Validasi untuk field tambahan mahasiswa jika role-nya Mahasiswa
        'tanggal_lahir' => $request->input('role_id') == 1 ? 'required|date' : '',
        'jenis_kelamin' => $request->input('role_id') == 1 ? 'required|in:L,P' : '',
        'asal_sekolah' => $request->input('role_id') == 1 ? 'required|string' : '',
        'nomor_telepon' => $request->input('role_id') == 1 ? 'required|string' : '',
        'nama_ayah' => $request->input('role_id') == 1 ? 'required|string' : '',
        'nama_ibu' => $request->input('role_id') == 1 ? 'required|string' : '',
        'nomor_telepon_ortu' => $request->input('role_id') == 1 ? 'required|string' : '',
    ]);

    // Update data user
    $user->update($validatedData);

    // Jika role Mahasiswa, update data mahasiswa (field mahasiswa langsung di tabel users)
    if ($request->input('role_id') == 1) {
        $user->update([
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'asal_sekolah' => $request->input('asal_sekolah'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'nomor_telepon_ortu' => $request->input('nomor_telepon_ortu'),
        ]);
    }

    return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
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
public function exportExcel(Request $request)
{
    return Excel::download(new UsersExport(
        $request->id,
        $request->name,
        $request->jenis_kelamin,
        $request->start_date,
        $request->end_date,
        $request->start_number,  // Menambahkan parameter untuk rentang nomor urut mulai
        $request->end_number     // Menambahkan parameter untuk rentang nomor urut akhir
    ), 'users.xlsx');
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
public function exportPdfFiltered(Request $request)
{
    return (new UsersPdfExport)->downloadFiltered($request);
}
}