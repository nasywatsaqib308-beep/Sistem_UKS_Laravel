@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Daftar Siswa</h5>
        <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->kelas ? $student->kelas->nama_kelas : '-' }}</td>
                    <td>{{ $student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    <td class="text-center">
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
