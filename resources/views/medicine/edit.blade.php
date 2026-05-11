@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Edit Data Obat</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('medicine.update', $medicine->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" value="{{ $medicine->nama_obat }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="{{ $medicine->satuan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ $medicine->stok }}" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('medicine.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection