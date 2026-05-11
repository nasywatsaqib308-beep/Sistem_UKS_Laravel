@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Tambah Data Obat Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('medicine.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" placeholder="Contoh: Paracetamol" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Contoh: Tablet, Botol, Strip" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Awal</label>
                        <input type="number" name="stok" class="form-control" min="0" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('medicine.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection