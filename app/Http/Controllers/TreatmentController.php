<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Student;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function index()
    {
        // Mengambil data kunjungan terbaru beserta relasi siswa dan obatnya
        $treatments = Treatment::with(['student', 'medicines'])->latest()->get();
        return view('treatment.index', compact('treatments'));
    }

    public function create()
    {
        $classes = \App\Models\Kelas::with('students')->get();
        $medicines = Medicine::where('stok', '>', 0)->get();
        return view('treatment.create', compact('classes', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'keluhan'    => 'required|string',
            'diagnosa'   => 'required|string',
            'medicine_ids' => 'nullable|array',
            'jumlahs' => 'nullable|array',
        ]);

        DB::transaction(function () use ($request) {
            $treatment = Treatment::create([
                'student_id'        => $request->student_id,
                'keluhan'           => $request->keluhan,
                'diagnosa'          => $request->diagnosa,
                'tanggal_kunjungan' => now(),
            ]);

            if ($request->has('medicine_ids')) {
                foreach ($request->medicine_ids as $index => $medicine_id) {
                    if (!$medicine_id) continue;
                    
                    $jumlah = $request->jumlahs[$index] ?? 0;
                    if ($jumlah > 0) {
                        $treatment->medicines()->attach($medicine_id, ['jumlah' => $jumlah]);
                        
                        $medicine = Medicine::find($medicine_id);
                        if ($medicine) {
                            $medicine->decrement('stok', $jumlah);
                        }
                    }
                }
            }
        });

        return redirect('/treatment')->with('success', 'Data kunjungan berhasil dicatat!');
    }

    /**
     * FITUR TAMBAHAN: Hapus Riwayat & Kembalikan Stok
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $treatment = Treatment::findOrFail($id);

            // 1. Balikin stok obat satu-satu sebelum datanya dihapus
            foreach ($treatment->medicines as $medicine) {
                $jumlahDiberikan = $medicine->pivot->jumlah;
                $medicine->increment('stok', $jumlahDiberikan);
            }

            // 2. Hapus data di tabel pivot (otomatis jika pakai cascade, tapi lebih aman manual)
            $treatment->medicines()->detach();

            // 3. Hapus data kunjungannya
            $treatment->delete();
        });

        return redirect('/treatment')->with('success', 'Riwayat kunjungan dihapus dan stok obat dikembalikan!');
    }

    public function report()
{
    $reports = Treatment::select(
        DB::raw('MONTH(tanggal_kunjungan) as bulan'),
        DB::raw('YEAR(tanggal_kunjungan) as tahun'),
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('bulan', 'tahun')
    ->orderBy('tahun', 'desc')
    ->orderBy('bulan', 'desc')
    ->get();

    return view('treatment.report', compact('reports'));
}
}