@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-secondary">Daftar Stok Obat (Real-time)</h5>
        
        {{-- TOMBOL TAMBAH: Hanya untuk Admin --}}
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('medicine.create') }}" class="btn btn-success btn-sm">+ Tambah Obat</a>
        @endif
    </div>
    
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Obat</th>
                    <th>Satuan</th>
                    <th class="text-center">Stok Tersisa</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicines as $medicine)
                <tr>
                    <td class="fw-bold">{{ $medicine->nama_obat }}</td>
                    <td>{{ $medicine->satuan }}</td>
                    <td class="text-center">{{ $medicine->stok }}</td>
                    <td>
                        @if($medicine->stok > 10)
                            <span class="badge bg-success">Tersedia</span>
                        @elseif($medicine->stok > 0)
                            <span class="badge bg-warning text-dark">Hampir Habis</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- AKSI: Edit & Hapus Hanya untuk Admin --}}
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('medicine.edit', $medicine->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('medicine.destroy', $medicine->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus obat ini?')">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted small italic">Akses Terbatas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data obat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection