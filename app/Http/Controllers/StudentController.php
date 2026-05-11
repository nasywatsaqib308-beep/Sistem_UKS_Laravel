<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = \App\Models\Student::with('kelas')->get();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classes = \App\Models\Kelas::all();
        return view('student.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:students',
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:classes,id',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        \App\Models\Student::create($request->all());
        return redirect()->route('student.index')->with('success', 'Siswa berhasil ditambah!');
    }

    public function edit(string $id)
    {
        $student = \App\Models\Student::findOrFail($id);
        $classes = \App\Models\Kelas::all();
        return view('student.edit', compact('student', 'classes'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|string|unique:students,nis,'.$id,
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:classes,id',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $student = \App\Models\Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('student.index')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $student = \App\Models\Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Siswa berhasil dihapus!');
    }
}
