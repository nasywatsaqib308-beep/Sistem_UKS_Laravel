@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Daftar Kelas</h5>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">+ Tambah Kelas</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $kelas)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td class="text-center">
                        <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" class="d-inline">
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
