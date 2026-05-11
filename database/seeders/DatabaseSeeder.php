<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Pembina',
            'email' => 'admin@uks.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Petugas PMR',
            'email' => 'petugas@uks.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        $kelas1 = \App\Models\Kelas::create(['nama_kelas' => 'X PPLG 1']);
        $kelas2 = \App\Models\Kelas::create(['nama_kelas' => 'X PPLG 2']);

        // Siswa X PPLG 1
        $siswaPPLG1 = [
            ['nis' => '1001', 'nama' => 'Andi Susanto', 'jenis_kelamin' => 'L'],
            ['nis' => '1002', 'nama' => 'Budi Pratama', 'jenis_kelamin' => 'L'],
            ['nis' => '1003', 'nama' => 'Citra Lestari', 'jenis_kelamin' => 'P'],
            ['nis' => '1004', 'nama' => 'Dewi Anggraini', 'jenis_kelamin' => 'P'],
            ['nis' => '1005', 'nama' => 'Eko Nugroho', 'jenis_kelamin' => 'L'],
        ];

        foreach ($siswaPPLG1 as $siswa) {
            \App\Models\Student::create(array_merge($siswa, ['kelas_id' => $kelas1->id]));
        }

        // Siswa X PPLG 2
        $siswaPPLG2 = [
            ['nis' => '2001', 'nama' => 'Fajar Hidayat', 'jenis_kelamin' => 'L'],
            ['nis' => '2002', 'nama' => 'Gita Savitri', 'jenis_kelamin' => 'P'],
            ['nis' => '2003', 'nama' => 'Hadi Suwondo', 'jenis_kelamin' => 'L'],
            ['nis' => '2004', 'nama' => 'Indah Permatasari', 'jenis_kelamin' => 'P'],
            ['nis' => '2005', 'nama' => 'Jamaludin', 'jenis_kelamin' => 'L'],
        ];

        foreach ($siswaPPLG2 as $siswa) {
            \App\Models\Student::create(array_merge($siswa, ['kelas_id' => $kelas2->id]));
        }

        \App\Models\Medicine::create([
            'nama_obat' => 'Paracetamol',
            'satuan' => 'Tablet',
            'stok' => 50
        ]);

        \App\Models\Medicine::create([
            'nama_obat' => 'Minyak Kayu Putih',
            'satuan' => 'Botol',
            'stok' => 15
        ]);
    }
}
