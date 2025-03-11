<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class MajorController extends Controller
{
    // Menampilkan daftar jurusan
    public function index()
    {
        $majors = Major::all();
        return response()->json($majors);
    }

    // Menyimpan jurusan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $major = Major::create([
            'name' => $request->name,
        ]);

        return response()->json($major, 201);
    }

    // Menampilkan detail jurusan tertentu
    public function show($id)
    {
        $major = Major::findOrFail($id);
        return response()->json($major);
    }

    // Mengupdate data jurusan
    public function update(Request $request, $id)
    {
        $major = Major::findOrFail($id);
        $major->update($request->all());

        return response()->json($major);
    }

    // Menghapus jurusan
    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return response()->json(['message' => 'Jurusan berhasil dihapus']);
    }
}