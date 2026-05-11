@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Tambah Kelas</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
