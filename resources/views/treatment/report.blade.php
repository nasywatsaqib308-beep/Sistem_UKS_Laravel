@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold text-primary">Rekapitulasi Kunjungan Siswa (Bulanan)</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Total Pasien (Siswa)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($reports as $r)
                <tr>
                    <td>{{ date("F", mktime(0, 0, 0, $r->bulan, 1)) }}</td>
                    <td>{{ $r->tahun }}</td>
                    <td class="fw-bold text-danger">{{ $r->total }} Orang</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button onclick="window.print()" class="btn btn-secondary btn-sm mt-3">🖨️ Cetak untuk Puskesmas</button>
    </div>
</div>
@endsection