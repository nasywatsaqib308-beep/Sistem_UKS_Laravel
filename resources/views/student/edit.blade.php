@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Edit Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('student.update', $student->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ $student->nis }}" required>
            </div>
            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" name="nama" class="form-control" value="{{ $student->nama }}" required>
            </div>
            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control" required>
                    @foreach($classes as $kelas)
                        <option value="{{ $kelas->id }}" {{ $student->kelas_id == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $student->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ $student->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('student.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
