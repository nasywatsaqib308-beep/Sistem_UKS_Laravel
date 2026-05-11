<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $classes = Kelas::all();
        return view('kelas.index', compact('classes'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255'
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kela) // Note: route parameter might be singular 'kela' by default due to pluralization, but we can bind it manually or use generic $id
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
