<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    /**
     * Menampilkan daftar semua obat
     */
    public function index() {
        $medicines = Medicine::all();
        return view('medicine.index', compact('medicines'));
    }

    /**
     * MENAMPILKAN FORM TAMBAH (Penting: Tambahkan bagian ini)
     */
    public function create() {
        return view('medicine.create');
    }

    /**
     * Menyimpan data obat baru ke database
     */
    public function store(Request $request) {
        $request->validate([
            'nama_obat' => 'required',
            'satuan'    => 'required',
            'stok'      => 'required|integer'
        ]);

        Medicine::create($request->all());
        return redirect('/medicine')->with('success', 'Obat berhasil ditambah!');
    }

    /**
     * Menampilkan form edit untuk satu obat
     */
    public function edit($id) {
        $medicine = Medicine::findOrFail($id); // Pakai findOrFail supaya kalau ID tidak ada, muncul error 404
        return view('medicine.edit', compact('medicine'));
    }

    /**
     * Memperbarui data obat di database
     */
    public function update(Request $request, $id) {
        $request->validate([
            'nama_obat' => 'required',
            'satuan'    => 'required',
            'stok'      => 'required|integer'
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());
        return redirect('/medicine')->with('success', 'Obat berhasil diupdate!');
    }

    /**
     * Menghapus data obat
     */
    public function destroy($id) {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return redirect('/medicine')->with('success', 'Obat berhasil dihapus!');
    }
}