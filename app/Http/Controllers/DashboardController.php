<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Student;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalMedicines = Medicine::count();
        
        // Obat yang mau habis (stok <= 10)
        $lowStockMedicines = Medicine::where('stok', '<=', 10)->get();
        
        // Total Kunjungan bulan ini
        $treatmentsThisMonth = Treatment::whereMonth('tanggal_kunjungan', Carbon::now()->month)
                                        ->whereYear('tanggal_kunjungan', Carbon::now()->year)
                                        ->count();
        
        // Kunjungan hari ini
        $treatmentsToday = Treatment::whereDate('tanggal_kunjungan', Carbon::today())->count();

        // Data Chart Kunjungan 6 Bulan Terakhir
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = Treatment::whereMonth('tanggal_kunjungan', $date->month)
                              ->whereYear('tanggal_kunjungan', $date->year)
                              ->count();
            $chartData['labels'][] = $date->translatedFormat('F Y');
            $chartData['data'][] = $count;
        }

        return view('dashboard', compact(
            'totalStudents', 'totalMedicines', 'lowStockMedicines', 
            'treatmentsThisMonth', 'treatmentsToday', 'chartData'
        ));
    }
}
