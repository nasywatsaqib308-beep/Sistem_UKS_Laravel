<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem UKS</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #f8faff 50%, #e8eaf6 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #333;
        }

        /* Color Palette Helpers */
        .text-navy { color: #0d47a1; }
        .bg-navy { background-color: #0d47a1; }
        .text-light-blue { color: #1976d2; }
        .bg-light-blue { background-color: #e3f2fd; }
        
        /* Navbar Customization */
        .navbar {
            background: rgba(13, 71, 161, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 3px solid #1976d2;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link:hover, .nav-link.active {
            color: #64b5f6 !important;
            transform: translateY(-2px);
        }

        /* Cards & Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
        }
        .card {
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(13, 71, 161, 0.1) !important;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        .table thead th {
            border-bottom: none;
            background-color: transparent;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .table tbody tr:hover {
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table tbody td {
            border-top: none;
            border-bottom: none;
            padding: 15px;
            vertical-align: middle;
        }
        .table tbody td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .table tbody td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #1976d2;
            border-color: #1976d2;
        }
        .btn-primary:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(25, 118, 210, 0.3);
        }
        
        .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand h1 fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="fas fa-heartbeat text-danger"></i> Sistem UKS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}"><i class="fas fa-chart-pie me-1"></i> Dashboard</a></li>
                        
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('kelas.*') ? 'active fw-bold' : '' }}" href="{{ route('kelas.index') }}"><i class="fas fa-chalkboard text-light opacity-75 me-1"></i> Kelas</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('student.*') ? 'active fw-bold' : '' }}" href="{{ route('student.index') }}"><i class="fas fa-user-graduate text-light opacity-75 me-1"></i> Siswa</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('treatment.report') ? 'active fw-bold' : '' }}" href="{{ route('treatment.report') }}"><i class="fas fa-file-alt text-light opacity-75 me-1"></i> Laporan</a></li>
                        @endif
                        
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('medicine.*') ? 'active fw-bold' : '' }}" href="{{ route('medicine.index') }}"><i class="fas fa-pills text-light opacity-75 me-1"></i> Obat</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('treatment.index') ? 'active fw-bold' : '' }}" href="{{ route('treatment.index') }}"><i class="fas fa-history text-light opacity-75 me-1"></i> Riwayat</a></li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-light btn-sm text-primary fw-bold px-3 rounded-pill shadow-sm" href="{{ route('treatment.create') }}">
                                <i class="fas fa-plus-circle me-1"></i> Kunjungan
                            </a>
                        </li>
                        
                        <li class="nav-item ms-lg-3 border-start ps-3 mt-3 mt-lg-0">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 30px; height: 30px; font-size: 14px;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <span>{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li><span class="dropdown-item-text text-muted small">Login sebagai: <span class="fw-bold text-navy">{{ ucfirst(auth()->user()->role) }}</span></span></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
