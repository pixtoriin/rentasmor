<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Neon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #00c6ff;
            --success-color: #00b09b;
            --warning-color: #f9d423;
            --danger-color: #ff416c;
            --light-bg: #f8f9fc;
            --dark-bg: #121218;
            --card-bg-light: rgba(255, 255, 255, 0.9);
            --card-bg-dark: rgba(30, 30, 40, 0.9);
            --text-light: #ffffff;
            --text-dark: #fff;
            --border-radius: 12px;
            --box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --box-shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.3);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-light);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
        }
        
        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--text-dark);
        }
        
        /* Navbar */
        .navbar {
            backdrop-filter: blur(15px);
            background: linear-gradient(135deg, rgba(9, 45, 57, 0.95) 0%, rgba(0, 66, 92, 0.95) 100%) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            color: white !important;
        }
        
        .dark-mode .navbar {
            background: linear-gradient(135deg, rgba(20, 20, 30, 0.95) 0%, rgba(30, 30, 50, 0.95) 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Texto e iconos blancos */
        .navbar * {
            color: white !important;
        }
        
        .navbar .nav-link,
        .navbar .dropdown-item,
        .navbar .form-check-label,
        .navbar .btn {
            color: white !important;
        }
        
        .navbar .nav-link i,
        .navbar .dropdown-item i,
        .navbar .btn i {
            color: white !important;
        }
        
        /* Efecto hover para los items del navbar */
        .navbar .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: var(--transition);
            border: none;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }
        
        /* Botón de cerrar sesión */
        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            border: none;
            border-radius: 30px;
            width: 50px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.4s ease;
            padding-left: 12px;
        }

        .logout-btn:hover {
            width: 160px;
            background: rgba(255, 65, 108, 0.8);
            padding-left: 15px;
        }

        .logout-btn i {
            position: absolute;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .logout-btn span {
            position: absolute;
            left: 100%;
            opacity: 0;
            transition: all 0.3s ease;
            white-space: nowrap;
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .logout-btn:hover i {
            left: 13px;
        }

        .logout-btn:hover span {
            opacity: 1;
            left: 35px;
        }
        
        .theme-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 30px;
            width: 50px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .logo_navbar {
            width: 8rem;
            filter: brightness(0) invert(1);
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            background-color: var(--card-bg-light);
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark-mode .card {
            background-color: var(--card-bg-dark);
            box-shadow: var(--box-shadow-dark);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .dark-mode .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        
        .card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(255, 255, 255, 0.05);
            font-weight: 600;
        }
        
        .dark-mode .card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Neon Gradients */
        .gradient-primary {
            background: linear-gradient(135deg, rgba(106, 17, 203, 0.8) 0%, rgba(155, 89, 182, 0.8) 100%);
            box-shadow: 0 4px 20px rgba(106, 17, 203, 0.3);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, rgba(0, 176, 155, 0.8) 0%, rgba(0, 230, 118, 0.8) 100%);
            box-shadow: 0 4px 20px rgba(0, 176, 155, 0.3);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, rgba(255, 165, 0, 0.8) 0%, rgba(249, 212, 35, 0.8) 100%);
            box-shadow: 0 4px 20px rgba(249, 212, 35, 0.3);
        }
        
        .gradient-danger {
            background: linear-gradient(135deg, rgba(255, 75, 43, 0.8) 0%, rgba(255, 65, 108, 0.8) 100%);
            box-shadow: 0 4px 20px rgba(255, 65, 108, 0.3);
        }
        
        .dark-mode .gradient-primary {
            background: linear-gradient(135deg, rgba(106, 17, 203, 0.6) 0%, rgba(155, 89, 182, 0.6) 100%);
            box-shadow: 0 4px 20px rgba(106, 17, 203, 0.5);
        }
        
        .dark-mode .gradient-success {
            background: linear-gradient(135deg, rgba(0, 176, 155, 0.6) 0%, rgba(0, 230, 118, 0.6) 100%);
            box-shadow: 0 4px 20px rgba(0, 176, 155, 0.5);
        }
        
        .dark-mode .gradient-warning {
            background: linear-gradient(135deg, rgba(249, 212, 35, 0.6) 0%, rgba(255, 165, 0, 0.6) 100%);
            box-shadow: 0 4px 20px rgba(249, 212, 35, 0.5);
        }
        
        .dark-mode .gradient-danger {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.6) 0%, rgba(255, 75, 43, 0.6) 100%);
            box-shadow: 0 4px 20px rgba(255, 65, 108, 0.5);
        }
        
        /* Card Icons */
        .card-icon {
            font-size: 2.5rem;
            opacity: 0.9;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
        
        .dark-mode .card-icon {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--bs-success), var(--bs-secondary));
            opacity: 0.5;
        }
        
        .timeline-item {
            position: relative;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            background-color: var(--card-bg-light);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dark-mode .timeline-item {
            background-color: var(--card-bg-dark);
            box-shadow: var(--box-shadow-dark);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.9rem;
            top: 1.5rem;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: var(--bs-primary);
            box-shadow: 0 0 0 4px rgba(106, 17, 203, 0.2);
            z-index: 1;
        }
        
        .timeline-item.success::before {
            background-color: var(--bs-success);
            box-shadow: 0 0 0 4px rgba(0, 176, 155, 0.2);
        }
        
        .timeline-item.warning::before {
            background-color: var(--bs-warning);
            box-shadow: 0 0 0 4px rgba(249, 212, 35, 0.2);
        }
        
        .timeline-item.secondary::before {
            background-color: var(--bs-secondary);
            box-shadow: 0 0 0 4px rgba(108, 117, 125, 0.2);
        }
        
        /* Table */
        .table {
            color: inherit;
        }
        
        .table th {
            font-weight: 600;
            border-bottom-width: 2px;
        }
        
        .dark-mode .table th,
        .dark-mode .table td {
            border-color: rgba(255, 255, 255, 0.05);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .dark-mode .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        /* Dark Mode Toggle */
        .form-check-input {
            width: 2.5em;
            height: 1.3em;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Progress Bars */
        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .dark-mode .progress {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Chart Container */
        .chart-container {
            background-color: var(--card-bg-light);
            border-radius: var(--border-radius);
            padding: 1rem;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dark-mode .chart-container {
            background-color: var(--card-bg-dark);
            box-shadow: var(--box-shadow-dark);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Mejoras para Mobile Tabs */
        .mobile-tabs {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(9, 45, 57, 0.98);
            z-index: 1000;
            box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.2);
            display: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dark-mode .mobile-tabs {
            background-color: rgba(20, 20, 30, 0.98);
        }
        
        .mobile-tabs .nav {
            display: flex;
            justify-content: space-around;
            padding: 0;
            margin: 0;
        }
        
        .mobile-tabs .nav-item {
            flex: 1;
            text-align: center;
        }
        
        .mobile-tabs .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.5rem;
            font-size: 0.7rem;
            text-align: center;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        
        .mobile-tabs .nav-link.active {
            color: white;
            background-color: rgba(106, 17, 203, 0.3);
        }
        
        .mobile-tabs .nav-link i {
            font-size: 1.4rem;
            margin-bottom: 0.3rem;
            transition: all 0.3s ease;
        }
        
        .mobile-tabs .nav-link.active i {
            transform: scale(1.1);
        }
        .mobile-tabs .nav-link.active span { 
            transform: translateY(-5px);
        }
        
        /* Mejor espaciado para el contenido móvil */
        .mobile-section {
            padding-bottom: 70px;
            display: none;
        }
        
        .mobile-section.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Media Queries */
        @media (max-width: 576px) {
            .card {
                border-radius: 12px;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .timeline-item {
                padding: 0.8rem;
            }
        }

        @media (max-width: 991.98px) {
            .mobile-tabs {
                display: block;
            }
            
            .desktop-section {
                display: none !important;
            }
            
            .navbar {
                display: none !important;
            }
            
            body {
                padding-bottom: 60px;
                padding-top: 0 !important;
            }
        }

        @media (min-width: 992px) {
            .mobile-section {
                display: none !important;
            }
        }


        /* Agrega esto al final de tu sección CSS */
        .mobile-section {
            overflow-x: hidden;
            width: 100%;
            touch-action: pan-y;
        }

        .mobile-sections-container {
            display: flex;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .mobile-section {
            flex: 0 0 100%;
            min-width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <img class="logo_navbar" src="{{ asset('imagenes/LogoRentasDirectas.svg') }}" alt="Logo Rentas Directas"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('welcome') }}">
                            <i class="bi bi-globe me-1"></i> Página principal
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <!-- Toggle del tema -->
                    <button class="theme-toggle" id="darkModeToggle">
                        <i class="bi" id="themeIcon"></i>
                    </button>
                    <!-- Botón de cerrar sesión mejorado -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-btn" type="submit">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Tabs -->
    <div class="mobile-tabs">
        <div class="container-fluid px-0">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-section="inicio">
                        <i class="bi bi-house-door"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="reservaciones">
                        <i class="bi bi-calendar-check"></i>
                        <span>Reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="reportes">
                        <i class="bi bi-graph-up"></i>
                        <span>Reportes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="configuracion">
                        <i class="bi bi-gear"></i>
                        <span>Ajustes</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Desktop Content -->
    <div class="desktop-section container-fluid mt-4">
        <div class="row mb-4 g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow h-100 py-2 gradient-primary text-white hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Reservaciones</div>
                                <div class="h2 mb-0 fw-bold">20</div>
                                <div class="mt-2 small">
                                    <span class="opacity-75"> del mes actual</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar-check card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow h-100 py-2 gradient-success text-white hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Casas disponibles</div>
                                <div class="h2 mb-0 fw-bold">50</div>
                                <div class="mt-2 small">
                                    <span class="opacity-75">  el siguiente fin</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-house-check card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow h-100 py-2 gradient-warning text-white hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Ingreso</div>
                                <div class="h2 mb-0 fw-bold">$35,000</div>
                                <div class="mt-2 small">
                                    <span class="opacity-75"> semanal</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow h-100 py-2 gradient-danger text-white hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">RESERVACIONES</div>
                                <div class="h2 mb-0 fw-bold">45</div>
                                <div class="mt-2 small">
                                    <span class="opacity-75"> totales cerradas</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar-minus card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
           <div class="col-lg-6">
                <!-- Chart -->
                <div class="card mb-4 hover-scale">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold">
                                <i class="bi bi-bar-chart-line me-2"></i>Reservaciones Mensuales
                            </h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown">
                                    <i class="bi bi-filter"></i> Filtros
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Filtrar por</h6></li>
                                    <li><a class="dropdown-item" href="#">2025</a></li>
                                    <li><a class="dropdown-item" href="#">2024</a></li>
                                    <li><a class="dropdown-item" href="#">2023</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Todos los años</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div id="apexChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-6">
                <!-- Timeline -->
                <div class="card mb-4 hover-scale">
                    <div class="card-header bg-transparent">
                        <h6 class="m-0 fw-bold">
                            <i class="bi bi-calendar2-week me-2"></i>Próximas Reservaciones
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item success">
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-title fw-bold mb-1">Casa LIZ</h6>
                                    <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Jueves, 17 / 04 / 25</small>
                                </div>
                                <p class="small mb-0 text-muted">Luis Adolfo Castellanos Manjarrez</p>
                            </div>
                            <div class="timeline-item success">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">Casa LIZ</h6>
                                    <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Lunes, 21 / 04 / 25</small>
                                </div>
                                <p class="small mb-0 text-muted">Petra Ernestina Tabira Porcayo</p>
                            </div>
                            <div class="timeline-item secondary">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">Casa LIZ</h6>
                                    <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25 / 04 / 25</small>
                                </div>
                                <p class="small mb-0 text-muted">Edgar Ivan Cruz Duran</p>
                            </div>
                            <div class="timeline-item secondary">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">Casa Verde</h6>
                                    <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25 / 04 / 25</small>
                                </div>
                                <p class="small mb-0 text-muted">Rafael Fuentes Aburto</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold">
                            <i class="bi bi-table me-2"></i>Reservaciones
                        </h6>
                        <div class="d-flex align-items-center">
                            <div class="me-3 d-none d-md-block">
                                <select class="form-select form-select-sm" id="items-per-page">
                                    <option value="5" selected>5 por página</option>
                                    <option value="10">10 por página</option>
                                    <option value="25">25 por página</option>
                                    <option value="50">50 por página</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-plus-circle me-1"></i> Nueva reservación
                            </button>
                            <div class="dropdown d-inline">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i> Filtrar
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Estado</h6></li>
                                    <li><a class="dropdown-item" href="#">Todos</a></li>
                                    <li><a class="dropdown-item" href="#">Activos</a></li>
                                    <li><a class="dropdown-item" href="#">Completados</a></li>
                                    <li><a class="dropdown-item" href="#">Pendientes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Versión Escritorio (se muestra en md y superior) -->
                        <div class="d-none d-md-block">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Estado</th>
                                            <th>Casa</th>
                                            <th>Entrada</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Anticipo</th>
                                            <th>Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="desktop-table-body">
                                        <!-- Los datos dinámicos se insertarán aquí -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted" id="desktop-pagination-info">Mostrando 1 a 5 de 50 registros</div>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0" id="desktop-pagination">
                                        <!-- Paginación dinámica -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Sections -->
    <div class="mobile-section active" id="mobile-inicio">
        <div class="container-fluid mt-4">  
            <div class="row">
                <div class="col-12">
                    <!-- Timeline -->
                    <div class="card mb-4 hover-scale">
                        <div class="card-header bg-transparent">
                            <h6 class="m-0 fw-bold">
                                <i class="bi bi-calendar2-week me-2"></i>Próximas Reservaciones
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item success">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title fw-bold mb-1">Casa LIZ</h6>
                                        <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Jueves, 17 / 04 / 25</small>
                                    </div>
                                    <p class="small mb-0 text-muted">Luis Adolfo Castellanos Manjarrez</p>
                                </div>
                                <div class="timeline-item success">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold mb-1">Casa LIZ</h6>
                                        <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Lunes, 21 / 04 / 25</small>
                                    </div>
                                    <p class="small mb-0 text-muted">Petra Ernestina Tabira Porcayo</p>
                                </div>
                                <div class="timeline-item secondary">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold mb-1">Casa LIZ</h6>
                                        <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25 / 04 / 25</small>
                                    </div>
                                    <p class="small mb-0 text-muted">Edgar Ivan Cruz Duran</p>
                                </div>
                                <div class="timeline-item secondary">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold mb-1">Casa Verde</h6>
                                        <small class="text-muted"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25 / 04 / 25</small>
                                    </div>
                                    <p class="small mb-0 text-muted">Rafael Fuentes Aburto</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-section" id="mobile-reservaciones">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold">
                                <i class="bi bi-table me-2"></i>Reservaciones
                            </h6>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-plus-circle me-1"></i> Nueva reservación
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <select class="form-select form-select-sm" id="mobile-items-per-page-tab">
                                    <option value="5" selected>5 por página</option>
                                    <option value="10">10 por página</option>
                                    <option value="25">25 por página</option>
                                    <option value="50">50 por página</option>
                                </select>
                            </div>
                            <div class="row g-3" id="mobile-table-body-tab">
                                <!-- Los datos dinámicos se insertarán aquí -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted" id="mobile-pagination-info-tab">Mostrando 1 a 5 de 50 registros</div>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0" id="mobile-pagination-tab">
                                        <!-- Paginación dinámica -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-section" id="mobile-reportes">
        <div class="container-fluid mt-4">
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="card border-0 shadow h-100 py-2 gradient-primary text-white hover-scale">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Reservaciones</div>
                                    <div class="h2 mb-0 fw-bold">20</div>
                                    <div class="mt-2 small">
                                        <span class="opacity-75"> del mes actual</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-calendar-check card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 shadow h-100 py-2 gradient-success text-white hover-scale">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Casas disponibles</div>
                                    <div class="h2 mb-0 fw-bold">50</div>
                                    <div class="mt-2 small">
                                        <span class="opacity-75">  el siguiente fin</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-house-check card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 shadow h-100 py-2 gradient-warning text-white hover-scale">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">Ingreso</div>
                                    <div class="h2 mb-0 fw-bold">$35,000</div>
                                    <div class="mt-2 small">
                                        <span class="opacity-75"> semanal</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-currency-dollar card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 shadow h-100 py-2 gradient-danger text-white hover-scale">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">RESERVACIONES</div>
                                    <div class="h2 mb-0 fw-bold">45</div>
                                    <div class="mt-2 small">
                                        <span class="opacity-75"> totales cerradas</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-calendar-minus card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 hover-scale">
                        <div class="card-header bg-transparent">
                            <h6 class="m-0 fw-bold">
                                <i class="bi bi-bar-chart-line me-2"></i>Reservaciones Mensuales
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="apexChartReportes"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-section" id="mobile-configuracion">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold">
                                <i class="bi bi-gear me-2"></i>Configuración
                            </h6>
                        </div>
                        <div class="card-body">
                            <form id="mobileSettingsForm">
                                <div class="mb-3">
                                    <label class="form-label">Tema</label>
                                    <select class="form-select" id="mobileThemeSelect">
                                        <option value="light">Claro</option>
                                        <option value="dark">Oscuro</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notificaciones</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="notificacionesSwitch" checked>
                                        <label class="form-check-label" for="notificacionesSwitch">Recibir notificaciones</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plantilla para filas en versión escritorio -->
    <template id="desktop-row-template">
        <tr>
            <td><span class="badge bg-success bg-opacity-10 text-success">En reservación</span></td>
            <td class="fw-bold">Casa Verde</td>
            <td>VIE 16, MAY 25</td>
            <td>Brenda Daniela Rodriguez Cruz</td>
            <td>7774432521</td>
            <td>$1500</td>
            <td>$9500</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </td>
        </tr>
    </template>

    <!-- Plantilla para cards en versión móvil -->
    <template id="mobile-row-template">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Casa Verde</span>
                    <span class="badge bg-success bg-opacity-10 text-success">En reservación</span>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <small class="text-muted">Nombre</small>
                            <div>Brenda Daniela Rodriguez Cruz</div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Entrada</small>
                            <div>VIE 16, MAY 25</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <small class="text-muted">Teléfono</small>
                            <div>7774432521</div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Anticipo</small>
                            <div>$1500</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <small class="text-muted">Total</small>
                            <div>$9500</div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Acciones</small>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>
        // Gestión del tema oscuro/claro
        const themeManager = {
            init() {
                this.loadThemePreference();
                this.setupEventListeners();
            },
            
            loadThemePreference() {
                const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
                document.body.classList.toggle('dark-mode', darkModeEnabled);
                this.updateThemeIcon(darkModeEnabled ? 'dark' : 'light');
                
                // Sincronizar con el selector móvil si existe
                const mobileThemeSelect = document.getElementById('mobileThemeSelect');
                if (mobileThemeSelect) {
                    mobileThemeSelect.value = darkModeEnabled ? 'dark' : 'light';
                }
            },
            
            toggleTheme() {
                const isDark = document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
                this.updateThemeIcon(isDark ? 'dark' : 'light');
            },
            
            updateThemeIcon(theme) {
                const themeIcon = document.getElementById('themeIcon');
                if (!themeIcon) return;
                
                themeIcon.classList.toggle('bi-sun-fill', theme === 'light');
                themeIcon.classList.toggle('bi-moon-fill', theme === 'dark');
            },
            
            setupEventListeners() {
                const darkModeToggle = document.getElementById('darkModeToggle');
                if (darkModeToggle) {
                    darkModeToggle.addEventListener('click', () => this.toggleTheme());
                }
                
                const mobileThemeSelect = document.getElementById('mobileThemeSelect');
                if (mobileThemeSelect) {
                    mobileThemeSelect.addEventListener('change', (e) => {
                        this.toggleTheme();
                    });
                }
            }
        };

        // Gestión de la tabla de reservaciones
        const tableManager = {
            data: [],
            currentPage: 1,
            itemsPerPage: 5,
            
            init() {
                this.loadData().then(() => {
                    this.setupEventListeners();
                    this.renderTable();
                });
            },
            
            async loadData() {
                // Simular carga de datos
                await new Promise(resolve => setTimeout(resolve, 300));
                
                this.data = Array.from({length: 50}, (_, i) => ({
                    id: i + 1,
                    estado: ['En reservación', 'Cerrada'][i % 2],
                    casa: ['Casa Verde', 'Casa Liz', 'Casa Azul', 'Casa Roja', 'Casa Amarilla'][i % 5],
                    entrada: `VIE ${i % 30 + 1}, ${['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN'][i % 6]} ${i % 10 + 20}`,
                    nombre: `Cliente ${i + 1} Apellido${i + 1}`,
                    telefono: `777${Math.floor(1000000 + Math.random() * 9000000)}`,
                    anticipo: `$${Math.floor(500 + Math.random() * 2000)}`,
                    total: `$${Math.floor(2000 + Math.random() * 10000)}`
                }));
            },
            
            setupEventListeners() {
                // Items por página
                const itemsPerPageSelects = [
                    document.getElementById('items-per-page'),
                    document.getElementById('mobile-items-per-page-tab')
                ].filter(Boolean);
                
                itemsPerPageSelects.forEach(select => {
                    select.addEventListener('change', (e) => {
                        this.itemsPerPage = parseInt(e.target.value);
                        this.currentPage = 1;
                        this.renderTable();
                    });
                });
            },
            
            renderTable() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                const pageData = this.data.slice(start, end);
                
                this.renderDesktopTable(pageData);
                this.renderMobileTable(pageData);
                this.updatePagination();
            },
            
            renderDesktopTable(data) {
                const template = document.getElementById('desktop-row-template');
                const tbody = document.getElementById('desktop-table-body');
                
                if (!template || !tbody) return;
                
                tbody.innerHTML = '';
                
                data.forEach(item => {
                    const clone = template.content.cloneNode(true);
                    const cells = clone.querySelectorAll('td');
                    
                    if (cells.length >= 7) {
                        cells[0].innerHTML = `<span class="badge ${this.getStatusClass(item.estado)}">${item.estado}</span>`;
                        cells[1].textContent = item.casa;
                        cells[2].textContent = item.entrada;
                        cells[3].textContent = item.nombre;
                        cells[4].textContent = item.telefono;
                        cells[5].textContent = item.anticipo;
                        cells[6].textContent = item.total;
                        
                        tbody.appendChild(clone);
                    }
                });
            },
            
            renderMobileTable(data) {
                const template = document.getElementById('mobile-row-template');
                const container = document.getElementById('mobile-table-body-tab');
                
                if (!template || !container) return;
                
                container.innerHTML = '';
                
                data.forEach(item => {
                    const clone = template.content.cloneNode(true);
                    const cardHeader = clone.querySelector('.card-header');
                    const cardBody = clone.querySelector('.card-body');
                    
                    if (cardHeader && cardBody) {
                        // Configurar header
                        const title = cardHeader.querySelector('.fw-bold');
                        const badge = cardHeader.querySelector('.badge');
                        if (title) title.textContent = item.casa;
                        if (badge) {
                            badge.className = `badge ${this.getStatusClass(item.estado)}`;
                            badge.textContent = item.estado;
                        }
                        
                        // Configurar body
                        const rows = cardBody.querySelectorAll('.row');
                        if (rows.length >= 3) {
                            // Fila 1: Nombre y Entrada
                            const row1Cols = rows[0].querySelectorAll('div');
                            if (row1Cols.length >= 2) {
                                if (row1Cols[1].querySelector('div')) 
                                    row1Cols[1].querySelector('div').textContent = item.nombre;
                                if (row1Cols[3]?.querySelector('div')) 
                                    row1Cols[3].querySelector('div').textContent = item.entrada;
                            }
                            
                            // Fila 2: Teléfono y Anticipo
                            const row2Cols = rows[1].querySelectorAll('div');
                            if (row2Cols.length >= 2) {
                                if (row2Cols[1].querySelector('div')) 
                                    row2Cols[1].querySelector('div').textContent = item.telefono;
                                if (row2Cols[3]?.querySelector('div')) 
                                    row2Cols[3].querySelector('div').textContent = item.anticipo;
                            }
                            
                            // Fila 3: Total y Acciones
                            const row3Cols = rows[2].querySelectorAll('div');
                            if (row3Cols.length >= 2) {
                                if (row3Cols[1].querySelector('div')) 
                                    row3Cols[1].querySelector('div').textContent = item.total;
                            }
                        }
                        
                        container.appendChild(clone);
                    }
                });
            },
            
            updatePagination() {
                const totalPages = Math.ceil(this.data.length / this.itemsPerPage);
                const totalItems = this.data.length;
                const from = (this.currentPage - 1) * this.itemsPerPage + 1;
                const to = Math.min(this.currentPage * this.itemsPerPage, totalItems);
                
                // Actualizar todos los controles de paginación
                this.updatePaginationElement('desktop-pagination', totalPages);
                this.updatePaginationElement('mobile-pagination-tab', totalPages);
                
                // Actualizar información de paginación
                this.updatePaginationInfo('desktop-pagination-info', from, to, totalItems);
                this.updatePaginationInfo('mobile-pagination-info-tab', from, to, totalItems);
            },
            
            updatePaginationElement(elementId, totalPages) {
                const pagination = document.getElementById(elementId);
                if (!pagination) return;
                
                pagination.innerHTML = '';
                
                // Botón Anterior
                const prevLi = this.createPaginationItem('Anterior', this.currentPage === 1);
                prevLi.addEventListener('click', () => {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.renderTable();
                    }
                });
                pagination.appendChild(prevLi);
                
                // Números de página
                for (let i = 1; i <= totalPages; i++) {
                    const pageLi = this.createPaginationItem(i, false, i === this.currentPage);
                    pageLi.addEventListener('click', () => {
                        this.currentPage = i;
                        this.renderTable();
                    });
                    pagination.appendChild(pageLi);
                }
                
                // Botón Siguiente
                const nextLi = this.createPaginationItem('Siguiente', this.currentPage === totalPages);
                nextLi.addEventListener('click', () => {
                    if (this.currentPage < totalPages) {
                        this.currentPage++;
                        this.renderTable();
                    }
                });
                pagination.appendChild(nextLi);
            },
            
            createPaginationItem(text, isDisabled, isActive = false) {
                const li = document.createElement('li');
                li.className = `page-item ${isDisabled ? 'disabled' : ''} ${isActive ? 'active' : ''}`;
                
                const a = document.createElement('a');
                a.className = 'page-link';
                a.href = '#';
                a.textContent = text;
                
                a.addEventListener('click', (e) => e.preventDefault());
                li.appendChild(a);
                
                return li;
            },
            
            updatePaginationInfo(elementId, from, to, total) {
                const element = document.getElementById(elementId);
                if (element) {
                    element.textContent = `Mostrando ${from} a ${to} de ${total} registros`;
                }
            },
            
            getStatusClass(status) {
                if (!status) return 'bg-secondary bg-opacity-10 text-secondary';
                
                const statusMap = {
                    'en reservación': 'bg-success bg-opacity-10 text-success',
                    'cerrada': 'bg-danger bg-opacity-10 text-danger',
                    'pendiente': 'bg-warning bg-opacity-10 text-warning'
                };
                
                return statusMap[status.toLowerCase()] || 'bg-secondary bg-opacity-10 text-secondary';
            }
        };

        // Gestión de las secciones móviles
        const mobileSectionManager = {
            init() {
                this.setupEventListeners();
                this.switchSection('inicio');
            },
            
            setupEventListeners() {
                const navLinks = document.querySelectorAll('[data-section]');
                navLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const section = link.getAttribute('data-section');
                        this.switchSection(section);
                    });
                });
                
                // Manejar cambios de tamaño de pantalla
                window.addEventListener('resize', () => this.handleResize());
            },
            
            switchSection(section) {
                // Actualizar pestaña activa
                document.querySelectorAll('[data-section]').forEach(navLink => {
                    navLink.classList.toggle('active', navLink.getAttribute('data-section') === section);
                });
                
                // Mostrar sección correspondiente
                document.querySelectorAll('.mobile-section').forEach(sec => {
                    sec.classList.remove('active');
                });
                document.getElementById(`mobile-${section}`).classList.add('active');
            },
            
            handleResize() {
                const isMobileView = window.innerWidth < 992;
                const desktopSection = document.querySelector('.desktop-section');
                
                if (isMobileView) {
                    desktopSection.style.display = 'none';
                } else {
                    desktopSection.style.display = 'block';
                    document.querySelectorAll('.mobile-section').forEach(sec => {
                        sec.classList.remove('active');
                    });
                }
            }
        };

        // Inicialización de gráficos
        const chartManager = {
            init() {
                this.renderCharts();
            },
            
            renderCharts() {
                const chartOptions = {
                    series: [{
                        name: 'Reservaciones',
                        data: [10, 15, 12, 18, 20, 25, 30, 28, 32, 35, 40, 18]
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: true
                        }
                    },
                    colors: ['#6a11cb'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.3,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    xaxis: {
                        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                    }
                };
                
                // Inicializar todos los gráficos
                new ApexCharts(document.querySelector("#apexChart"), chartOptions).render();
                new ApexCharts(document.querySelector("#apexChartReportes"), chartOptions).render();
            }
        };

        // Inicializar todos los módulos cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', () => {
            themeManager.init();
            tableManager.init();
            mobileSectionManager.init();
            chartManager.init();
            
            // Evitar envío del formulario de configuración móvil
            const mobileSettingsForm = document.getElementById('mobileSettingsForm');
            if (mobileSettingsForm) {
                mobileSettingsForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    alert('Configuración guardada localmente');
                });
            }
        });
    </script>
</body>
</html>