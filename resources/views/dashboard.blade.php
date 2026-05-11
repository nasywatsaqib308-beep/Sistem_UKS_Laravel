@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold text-navy mb-1">Dashboard UKS</h4>
        <p class="text-muted">Ringkasan data kesehatan siswa dan inventaris obat.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card bg-white shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <div class="stat-icon bg-light-blue text-primary mb-3">
                    <i class="fas fa-users fs-3"></i>
                </div>
                <h3 class="fw-bold text-navy mb-0">{{ $totalStudents }}</h3>
                <span class="text-muted small">Total Siswa</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <div class="stat-icon bg-light-blue text-success mb-3">
                    <i class="fas fa-pills fs-3"></i>
                </div>
                <h3 class="fw-bold text-navy mb-0">{{ $totalMedicines }}</h3>
                <span class="text-muted small">Total Jenis Obat</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <div class="stat-icon bg-light-blue text-warning mb-3">
                    <i class="fas fa-calendar-day fs-3"></i>
                </div>
                <h3 class="fw-bold text-navy mb-0">{{ $treatmentsToday }}</h3>
                <span class="text-muted small">Kunjungan Hari Ini</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <div class="stat-icon bg-light-blue text-danger mb-3">
                    <i class="fas fa-chart-line fs-3"></i>
                </div>
                <h3 class="fw-bold text-navy mb-0">{{ $treatmentsThisMonth }}</h3>
                <span class="text-muted small">Kunjungan Bulan Ini</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100 glass-card">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h6 class="fw-bold text-navy">Grafik Kunjungan (6 Bulan Terakhir)</h6>
            </div>
            <div class="card-body">
                <canvas id="kunjunganChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100 glass-card">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h6 class="fw-bold text-danger"><i class="fas fa-exclamation-circle me-1"></i> Peringatan Stok Obat</h6>
            </div>
            <div class="card-body">
                @if($lowStockMedicines->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($lowStockMedicines as $medicine)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 border-bottom-dashed">
                                <div>
                                    <span class="fw-bold text-secondary">{{ $medicine->nama_obat }}</span><br>
                                    <small class="text-muted">Sisa: {{ $medicine->stok }} {{ $medicine->satuan }}</small>
                                </div>
                                <span class="badge bg-danger rounded-pill">Segera Restock</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle text-success fs-1 mb-3 opacity-50"></i>
                        <p class="text-muted mb-0">Semua stok obat aman.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('kunjunganChart').getContext('2d');
        
        // Gradient fill untuk area chart
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 71, 161, 0.5)'); // Navy semi-transparent
        gradient.addColorStop(1, 'rgba(227, 242, 253, 0.0)'); // Light blue transparent

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Jumlah Kunjungan Siswa',
                    data: {!! json_encode($chartData['data']) !!},
                    borderColor: '#0d47a1',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#0d47a1',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // membuat garis melengkung smooth
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0d47a1',
                        titleFont: { family: 'Poppins', size: 13 },
                        bodyFont: { family: 'Poppins', size: 14, weight: 'bold' },
                        padding: 10,
                        displayColors: false,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: { family: 'Poppins' }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: { family: 'Poppins' }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
