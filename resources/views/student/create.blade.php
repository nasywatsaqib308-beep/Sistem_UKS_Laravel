@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Tambah Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classes as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('student.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
