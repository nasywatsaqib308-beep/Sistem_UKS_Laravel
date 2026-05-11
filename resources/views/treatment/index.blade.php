@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-secondary">Log Kunjungan Siswa</h5>
        <span class="badge bg-primary">{{ $treatments->count() }} Total Kunjungan</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Nama Siswa</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Obat Diberikan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($treatments as $t)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_kunjungan)->format('d M Y, H:i') }}</td>
                        <td class="fw-bold">{{ $t->student->nama }}</td>
                        <td>{{ $t->keluhan }}</td>
                        <td><span class="text-muted italic">{{ $t->diagnosa }}</span></td>
                        <td>
                            @foreach($t->medicines as $m)
                                <span class="badge rounded-pill bg-info text-dark">
                                    {{ $m->nama_obat }} ({{ $m->pivot->jumlah }})
                                </span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if(auth()->user()->role == 'admin')
                            <form action="{{ route('treatment.destroy', $t->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Batalkan kunjungan ini? Stok obat akan otomatis dikembalikan.')">
                                    Batal
                                </button>
                            </form>
                            @else
                            <span class="text-muted small">N/A</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat kunjungan hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
