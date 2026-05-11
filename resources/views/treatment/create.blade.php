@extends('layouts.app')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row justify-content-center pb-5">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary">Form Catatan Kunjungan Siswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('treatment.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Siswa (Bisa di ketik untuk mencari)</label>
                        <select name="student_id" class="form-select select2" required>
                            <option value="" selected disabled>-- Cari Nama Siswa --</option>
                            @foreach($classes as $kelas)
                                <optgroup label="Kelas: {{ $kelas->nama_kelas }}">
                                    @foreach($kelas->students as $s)
                                        <option value="{{ $s->id }}">{{ $s->nis }} - {{ $s->nama }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="2" placeholder="Contoh: Pusing, mual" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Diagnosa Awal</label>
                        <input type="text" name="diagnosa" class="form-control" placeholder="Contoh: Gejala Maag" required>
                    </div>
                    
                    <hr>
                    <h6 class="fw-bold mb-3 text-secondary">Pemberian Obat</h6>
                    
                    <div id="obat-wrapper">
                        <!-- Baris obat dinamis akan ditambahkan di sini -->
                        <div class="row mb-2 obat-row">
                            <div class="col-md-7 mb-2">
                                <select name="medicine_ids[]" class="form-select select2-obat">
                                    <option value="">-- Tidak Diberi Obat / Pilih Obat --</option>
                                    @foreach($medicines as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_obat }} (Sisa Stok: {{ $m->stok }} {{ $m->satuan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <input type="number" name="jumlahs[]" class="form-control" placeholder="Jumlah" min="1">
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="button" class="btn btn-outline-danger w-100 btn-hapus-obat" disabled>Hapus</button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-sm btn-outline-success mt-2" id="btn-tambah-obat">+ Tambah Obat Lain</button>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Data Kunjungan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (dibutuhkan Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Aktifkan select2 untuk pencarian siswa yang lebih mudah
        $('.select2').select2({
            theme: 'classic',
            width: '100%'
        });

        // Simpan template obat row untuk duplicate
        var obatRowHTML = $('.obat-row').first().prop('outerHTML');

        // Fungsi tambah obat
        $('#btn-tambah-obat').click(function() {
            var newRow = $(obatRowHTML);
            // Aktifkan tombol hapus di baris baru
            newRow.find('.btn-hapus-obat').removeAttr('disabled');
            // Kosongkan value input
            newRow.find('input[type="number"]').val('');
            
            $('#obat-wrapper').append(newRow);
        });

        // Fungsi hapus obat
        $(document).on('click', '.btn-hapus-obat', function() {
            // Jangan hapus jika sisa 1 baris
            if ($('.obat-row').length > 1) {
                $(this).closest('.obat-row').remove();
            }
        });
    });
</script>
@endsection