<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Neon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --text-dark: #000000;
            --border-radius: 12px;
            --box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --box-shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.3);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
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

    <style>
        /* En tu archivo CSS */
        .note-editor {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .note-editor.border-danger {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

        .note-editor.border-success {
            border-color: #198754 !important;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .is-invalid ~ .invalid-feedback,
        .is-invalid ~ .note-editor + .invalid-feedback {
            display: block;
        }
    </style>

    <style>
        /* Estilos para la galería de imágenes */
        #imageGallery {
            min-height: 100px;
        }

        .image-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            aspect-ratio: 1 / 1;
        }

        .image-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-card:hover .image-actions {
            opacity: 1;
        }

        .dropzone {
            background-color: rgba(0,0,0,0.02);
            border: 2px dashed #ced4da !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dropzone:hover {
            background-color: rgba(0,0,0,0.05);
            border-color: #6a11cb !important;
        }

        .dz-message {
            padding: 20px;
        }

        /* Estilos para las miniaturas de imágenes */
        .thumbnail-container {
            position: relative;
            margin-bottom: 15px;
        }

        .thumbnail {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
        }

        .upload-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 5px;
            background-color: #f1f1f1;
        }

        .progress-bar {
            height: 100%;
            background-color: #6a11cb;
            width: 0%;
            transition: width 0.3s ease;
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
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#nuevaCasaModal">
                            <i class="bi bi-house-add-fill me-1"></i> Nueva casa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#iraCasaModal">
                            <i class="bi bi-house-up-fill me-1"></i> Ir a casa
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
        <!-- Tarjetas de resumen -->
        <div class="row mb-4 g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Reservaciones</div>
                                <div class="h3 mb-0 fw-bold text-dark">20</div>
                                <div class="mt-2 small text-muted">del mes actual</div>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-calendar-check text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Casas disponibles</div>
                                <div class="h3 mb-0 fw-bold text-dark">50</div>
                                <div class="mt-2 small text-muted">el siguiente fin</div>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-house-check text-success" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Ingreso</div>
                                <div class="h3 mb-0 fw-bold text-dark">$35,000</div>
                                <div class="mt-2 small text-muted">semanal</div>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-currency-dollar text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-uppercase mb-1 text-muted">RESERVACIONES</div>
                                <div class="h3 mb-0 fw-bold text-dark">45</div>
                                <div class="mt-2 small text-muted">totales cerradas</div>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-calendar-minus text-danger" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gráfico y calendario -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4 hover-scale">
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold text-dark">
                                <i class="bi bi-bar-chart-line me-2 text-primary"></i>Reservaciones Mensuales
                            </h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown">
                                    <i class="bi bi-filter text-muted"></i> Filtros
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><h6 class="dropdown-header small">Filtrar por</h6></li>
                                    <li><a class="dropdown-item small" href="#">2025</a></li>
                                    <li><a class="dropdown-item small" href="#">2024</a></li>
                                    <li><a class="dropdown-item small" href="#">2023</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item small" href="#">Todos los años</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="chart-container">
                            <div id="apexChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4 hover-scale">
                    <div class="card-header bg-white border-0">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="bi bi-calendar2-week me-2 text-primary"></i>Próximas Reservaciones
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item success border-0 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Casa LIZ</h6>
                                        <small class="text-muted">Luis Adolfo Castellanos Manjarrez</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success bg-opacity-10 text-success small">Confirmada</span>
                                        <div class="text-muted small mt-1"><i class="bi bi-calendar4-event me-1"></i>Jueves, 17/04/25</div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item success border-0 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Casa LIZ</h6>
                                        <small class="text-muted">Petra Ernestina Tabira Porcayo</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success bg-opacity-10 text-success small">Confirmada</span>
                                        <div class="text-muted small mt-1"><i class="bi bi-calendar4-event me-1"></i>Lunes, 21/04/25</div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item secondary border-0 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Casa LIZ</h6>
                                        <small class="text-muted">Edgar Ivan Cruz Duran</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary small">Pendiente</span>
                                        <div class="text-muted small mt-1"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25/04/25</div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item secondary border-0 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Casa Verde</h6>
                                        <small class="text-muted">Rafael Fuentes Aburto</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary small">Pendiente</span>
                                        <div class="text-muted small mt-1"><i class="bi bi-calendar4-event me-1"></i>Viernes, 25/04/25</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabla de reservaciones -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="bi bi-table me-2 text-primary"></i>Reservaciones
                        </h6>
                        <div class="d-flex align-items-center">
                            <div class="me-3 d-none d-md-block">
                                <select class="form-select form-select-sm border-0 shadow-sm" id="items-per-page">
                                    <option value="5" selected>5 por página</option>
                                    <option value="10">10 por página</option>
                                    <option value="25">25 por página</option>
                                    <option value="50">50 por página</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-plus-circle me-1"></i> Nueva
                            </button>
                            <div class="dropdown d-inline">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i> Filtrar
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><h6 class="dropdown-header small">Estado</h6></li>
                                    <li><a class="dropdown-item small" href="#">Todos</a></li>
                                    <li><a class="dropdown-item small" href="#">Activos</a></li>
                                    <li><a class="dropdown-item small" href="#">Completados</a></li>
                                    <li><a class="dropdown-item small" href="#">Pendientes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- Versión Escritorio (se muestra en md y superior) -->
                        <div class="d-none d-md-block">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-muted small fw-normal">Estado</th>
                                            <th class="text-muted small fw-normal">Casa</th>
                                            <th class="text-muted small fw-normal">Entrada</th>
                                            <th class="text-muted small fw-normal">Nombre</th>
                                            <th class="text-muted small fw-normal">Teléfono</th>
                                            <th class="text-muted small fw-normal">Anticipo</th>
                                            <th class="text-muted small fw-normal">Total</th>
                                            <th class="text-muted small fw-normal">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="desktop-table-body" class="border-top-0">
                                        <!-- Los datos dinámicos se insertarán aquí -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                <div class="text-muted small" id="desktop-pagination-info">Mostrando 1 a 5 de 50 registros</div>
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
                    <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-primary border-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Reservaciones</div>
                                    <div class="h2 mb-0 fw-bold text-dark">20</div>
                                    <div class="mt-2 small text-muted">
                                        <span>del mes actual</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-calendar-check text-primary card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-success border-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Casas disponibles</div>
                                    <div class="h2 mb-0 fw-bold text-dark">50</div>
                                    <div class="mt-2 small text-muted">
                                        <span>el siguiente fin</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-house-check text-success card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-warning border-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 text-muted">Ingreso</div>
                                    <div class="h2 mb-0 fw-bold text-dark">$35,000</div>
                                    <div class="mt-2 small text-muted">
                                        <span>semanal</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-currency-dollar text-warning card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border-0 h-100 py-2 bg-white shadow-sm hover-scale border-start border-danger border-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-uppercase mb-1 text-muted">RESERVACIONES</div>
                                    <div class="h2 mb-0 fw-bold text-dark">45</div>
                                    <div class="mt-2 small text-muted">
                                        <span>totales cerradas</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-calendar-minus text-danger card-icon"></i>
                                    </div>
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
                                <div class="mb-3">
                                    <label class="form-label">Configuración de Casas</label>
                                    <button type="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaCasaModal">
                                        <i class="bi bi-house-add-fill me-1"></i> Nueva casa
                                    </button>
                                    <button type="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#iraCasaModal">
                                        <i class="bi bi-house-up-fill me-1"></i> Ir a casa
                                    </button>
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



    <!-- Modal -->
    <div class="modal fade" id="nuevaCasaModal" tabindex="-1" aria-labelledby="nuevaCasaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fs-5" id="nuevaCasaModalLabel">🏠 Agregar Nueva Casa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="formNuevaCasa" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6 p-4 border-end">
                                <div class="mb-3">
                                    <label for="casa_nombre" class="form-label small text-muted">NOMBRE <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="casa_nombre" name="casa_nombre" required>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="casa_propietario" class="form-label small text-muted">PROPIETARIO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="casa_propietario" name="casa_propietario" required>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="casa_direccion" class="form-label small text-muted">DIRECCIÓN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="casa_direccion" name="casa_direccion" required>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="casa_municipio" class="form-label small text-muted">MUNICIPIO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="casa_municipio" name="casa_municipio" required>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6 p-4">
                                <div class="mb-3">
                                    <label for="casa_logo" class="form-label small text-muted">LOGO <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-sm" id="casa_logo" name="casa_logo" accept="image/*" required>
                                    <small class="text-muted d-block mt-1">JPG o PNG (Máx. 2MB)</small>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="casa_precioxnoche" class="form-label small text-muted">PRECIO/NOCHE <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0" class="form-control" id="casa_precioxnoche" name="casa_precioxnoche" required>
                                    </div>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="casa_telefono" class="form-label small text-muted">TELÉFONO <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-sm" id="casa_telefono" name="casa_telefono" required>
                                    <div class="invalid-feedback small">Requerido</div>
                                </div>
                                
                                <div class="form-check form-switch ps-0 mt-3">
                                    <label class="form-check-label small text-muted" for="casa_activo">ACTIVO</label>
                                    <input class="form-check-input float-end" type="checkbox" role="switch" id="casa_activo" name="casa_activo" checked>
                                </div>
                                
                                <!-- Vista previa del logo -->
                                <div class="mt-4 pt-3 border-top" id="logoPreviewContainer" style="display: none;">
                                    <label class="small text-muted">VISTA PREVIA</label>
                                    <img id="logoPreview" src="#" alt="Vista previa" class="img-fluid rounded d-block mx-auto mt-2" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="px-4 pb-4">
                            <label for="casa_descripcion" class="form-label small text-muted">DESCRIPCIÓN <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm summernote" id="casa_descripcion" name="casa_descripcion" rows="3" required></textarea>
                            <div class="invalid-feedback small">Requerido</div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="bi bi-save me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Modal Ir a Casa -->
    <div class="modal fade" id="iraCasaModal" tabindex="-1" aria-labelledby="iraCasaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fs-5">🏠 Administrar Casa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Selector -->
                    <div class="px-4 pb-3 border-bottom">
                        <label for="selectCasas" class="form-label small text-muted mb-1">SELECCIONE UNA CASA</label>
                        <select class="form-select form-select-sm" id="selectCasas">
                            <option disabled selected>Cargando casas...</option>
                        </select>
                    </div>

                    <!-- Formulario de Edición -->
                    <form id="formEditarCasa" enctype="multipart/form-data" style="display:none;">
                        <input type="hidden" id="casa_id" name="casa_id">
                        
                        <div class="p-4">
                            <div class="row g-3">
                                <!-- Primera columna -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label small text-muted">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" id="casa_nombre_edit" name="casa_nombre">
                                    
                                    <label class="form-label small text-muted mt-3">Dirección</label>
                                    <input type="text" class="form-control form-control-sm" id="casa_direccion_edit" name="casa_direccion">
                                    
                                    <label class="form-label small text-muted mt-3">Precio por noche</label>
                                    <input type="number" class="form-control form-control-sm" id="casa_precioxnoche_edit" name="casa_precioxnoche">
                                </div>
                                
                                <!-- Segunda columna -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label small text-muted">Propietario</label>
                                    <input type="text" class="form-control form-control-sm" id="casa_propietario_edit" name="casa_propietario">
                                    
                                    <label class="form-label small text-muted mt-3">Municipio</label>
                                    <input type="text" class="form-control form-control-sm" id="casa_municipio_edit" name="casa_municipio">
                                    
                                    <label class="form-label small text-muted mt-3">Teléfono</label>
                                    <input type="tel" class="form-control form-control-sm" id="casa_telefono_edit" name="casa_telefono">
                                </div>
                                
                                <!-- Campos de ancho completo -->
                                <div class="col-12">
                                    <label class="form-label small text-muted">Descripción</label>
                                    <textarea class="form-control form-control-sm" id="casa_descripcion_edit" name="casa_descripcion" rows="3"></textarea>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label small text-muted">Logo</label>
                                    <img id="logoCasaEdit" src="#" alt="Logo de la casa" class="img-fluid rounded mb-2 d-block mx-auto" style="max-height:120px; display:none;">
                                    <input type="file" class="form-control form-control-sm" id="casa_logo_edit" name="casa_logo" accept="image/*" style="display:none;">
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check form-switch ps-0">
                                        <label class="form-check-label small text-muted" for="casa_activo_edit">Activo</label>
                                        <input class="form-check-input float-end" type="checkbox" role="switch" id="casa_activo_edit" name="casa_activo">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                                <button type="button" id="editarCasaBtn" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil-square me-1"></i> Editar
                                </button>
                                <button type="button" id="cancelarEdicionBtn" class="btn btn-sm btn-outline-danger" style="display:none;">
                                    Cancelar
                                </button>
                                <button type="submit" id="guardarCambiosBtn" class="btn btn-sm btn-primary" style="display:none;">
                                    <i class="bi bi-save me-1"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Dentro del modal #iraCasaModal, después del formulario principal -->
                    <div class="p-4 border-top">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-images me-2"></i> Galería de Imágenes
                        </h6>
                        
                        <!-- Área para subir nuevas imágenes -->
                        <div class="mb-4">
                            <label class="form-label small text-muted">AGREGAR NUEVAS IMÁGENES</label>
                            <div class="dropzone border rounded p-3 text-center" id="imageDropzone">
                                <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" style="display:none;">
                                <div class="dz-message">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                                    <p class="mb-0">Arrastra imágenes aquí o haz clic para seleccionar</p>
                                    <small class="text-muted">Formatos: JPG, PNG (Máx. 5MB cada una)</small>
                                </div>
                            </div>
                            <div class="invalid-feedback small" id="imageUploadError"></div>
                        </div>
                        
                        <!-- Cuadrícula de imágenes existentes -->
                        <div class="row g-2" id="imageGallery">
                            <!-- Las imágenes existentes se cargarán aquí -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


<script>
$(document).ready(function () {
    // Inicializar Summernote para los campos de descripción
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
        disable: true // Deshabilitar inicialmente
    });

    // Mostrar modal de "Ir a Casa"
    $('#iraCasaModal').on('show.bs.modal', function () {
        cargarCasas();
        resetModalCasa();
    });

    // Selección de casa
    $('#selectCasas').change(function () {
        const casaId = $(this).val();
        if (casaId) {
            cargarInfoCasa(casaId);
        }
    });

    // Botón Editar
    $('#editarCasaBtn').click(function () {
        activarEdicion(true);
    });

    // Botón Cancelar Edición
    $('#cancelarEdicionBtn').click(function () {
        activarEdicion(false);
        // Recargar la información original al cancelar
        const casaId = $('#casa_id').val();
        cargarInfoCasa(casaId);
    });

    // Formulario para editar la casa
    $('#formEditarCasa').submit(function (e) {
        e.preventDefault();
        const casaId = $('#casa_id').val();
        const formData = new FormData(this);
                
        formData.set('casa_activo', $('#casa_activo_edit').is(':checked') ? '1' : '0');

        $.ajax({
            url: `{{ route('actualizarCasa') }}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                Swal.fire({
                    title: 'Guardando cambios...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function () {
                Swal.fire('¡Guardado!', 'Los cambios se guardaron correctamente.', 'success');
                activarEdicion(false);
                cargarInfoCasa(casaId); // Recargar info actualizada
            },
            error: function (xhr) {
                Swal.close();
                Swal.fire('Error', xhr.responseJSON?.message || 'Ocurrió un error.', 'error');
            }
        });
    });

    // Funciones

    function cargarCasas() {
        $.get("{{ route('buscarCasas') }}", function (response) {
            if (response.casas?.length) {
                let options = '<option value="" disabled selected>Seleccione una casa</option>';
                response.casas.forEach(casa => {
                    options += `<option value="${casa.casa_id}">${casa.casa_nombre} - ${casa.casa_municipio}</option>`;
                });
                $('#selectCasas').html(options);
            } else {
                $('#selectCasas').html('<option disabled>No hay casas registradas</option>');
            }
        }).fail(() => {
            $('#selectCasas').html('<option disabled>Error al cargar casas</option>');
        });
    }

    function cargarInfoCasa(casaId) {
        $.ajax({
            url: `{{ route('mostrarCasa') }}`,
            method: 'POST',
            data: {
                casa_id: casaId,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                const c = res.casa;
                $('#formEditarCasa input, #formEditarCasa textarea').prop('readonly', true).addClass('bg-light');
                $('#casa_id').val(c.casa_id);
                $('#casa_nombre_edit').val(c.casa_nombre);
                $('#casa_propietario_edit').val(c.casa_propietario);
                $('#casa_direccion_edit').val(c.casa_direccion);
                $('#casa_municipio_edit').val(c.casa_municipio);
                $('#casa_precioxnoche_edit').val(c.casa_precioxnoche);
                $('#casa_telefono_edit').val(c.casa_telefono);
                $('#casa_descripcion_edit').summernote('code', c.casa_descripcion || '');
                $('#casa_activo_edit').prop('checked', c.casa_activo);
                
                // Mostrar u ocultar imagen según exista
                if (c.casa_logo) {
                    $('#logoCasaEdit').attr('src', c.casa_logo).show();
                } else {
                    $('#logoCasaEdit').hide();
                }
                
                // Ocultar input de imagen en modo visualización
                $('#casa_logo_edit').hide();
                
                $('#formEditarCasa').show();
                $('#editarCasaBtn, #irACasaBtn').show();
                $('#guardarCambiosBtn, #cancelarEdicionBtn').hide();
                
                // Deshabilitar Summernote inicialmente
                $('#casa_descripcion_edit').summernote('disable');
                
                cargarImagenesCasa(casaId);
            },
            error: function() {
                Swal.fire('Error', 'No se pudo cargar la información.', 'error');
            }
        });
    }

    function activarEdicion(activo) {
        $('#formEditarCasa input, #formEditarCasa textarea').prop('readonly', !activo).toggleClass('bg-light', !activo);
        $('#casa_descripcion_edit').summernote(activo ? 'enable' : 'disable');
        $('#guardarCambiosBtn, #cancelarEdicionBtn').toggle(activo);
        $('#editarCasaBtn, #irACasaBtn').toggle(!activo);
        
        // Mostrar u ocultar input de imagen según modo edición
        if (activo) {
            $('#casa_logo_edit').show();
            $('#logoCasaEdit').hide();
        } else {
            $('#casa_logo_edit').hide();
            if ($('#casa_logo_edit').val() === '') {
                $('#logoCasaEdit').show();
            }
        }
    }

    function resetModalCasa() {
        $('#selectCasas').val('');
        $('#formEditarCasa').hide();
    }

    function cargarImagenesCasa(casaId) {
        $.ajax({
            url: `{{ route('obtenerImagenes') }}`,
            method: 'POST',
            data: {
                casa_id: casaId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                const gallery = $('#imageGallery');
                gallery.empty();
                
                if (response.imagenes && response.imagenes.length > 0) {
                    response.imagenes.forEach(imagen => {
                        gallery.append(crearTarjetaImagen(imagen));
                    });
                } else {
                    gallery.html('<div class="col-12 text-center py-4 text-muted"><i class="bi bi-images fs-1"></i><p>No hay imágenes para esta casa</p></div>');
                }
            },
            error: function() {
                $('#imageGallery').html('<div class="col-12 text-center py-4 text-danger">Error al cargar imágenes</div>');
            }
        });
    }

    function crearTarjetaImagen(imagen) {
        return `
            <div class="col-6 col-md-4 col-lg-3" data-img-id="${imagen.img_id}">
                <div class="image-card">
                    <img src="${imagen.img_url}" alt="Imagen de la casa" class="img-fluid">
                    <div class="image-actions">
                        <button class="btn btn-sm btn-danger btn-eliminar-imagen" data-img-id="${imagen.img_id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Configurar el dropzone para subir imágenes
    $(document).ready(function() {
        const dropzone = $('#imageDropzone');
        const fileInput = $('#imageUpload');
        
        dropzone.on('click', function() {
            fileInput.click();
        });
        
        fileInput.on('change', function(e) {
            if (this.files && this.files.length > 0) {
                subirImagenes(this.files);
            }
        });
        
        dropzone.on('dragover', function(e) {
            e.preventDefault();
            dropzone.addClass('border-primary');
            dropzone.css('background-color', 'rgba(106, 17, 203, 0.05)');
        });
        
        dropzone.on('dragleave', function(e) {
            e.preventDefault();
            dropzone.removeClass('border-primary');
            dropzone.css('background-color', 'rgba(0,0,0,0.02)');
        });
        
        dropzone.on('drop', function(e) {
            e.preventDefault();
            dropzone.removeClass('border-primary');
            dropzone.css('background-color', 'rgba(0,0,0,0.02)');
            
            if (e.originalEvent.dataTransfer.files.length > 0) {
                subirImagenes(e.originalEvent.dataTransfer.files);
            }
        });
        
        // Delegación de eventos para eliminar imágenes
        $(document).on('click', '.btn-eliminar-imagen', function() {
            const imgId = $(this).data('img-id');
            eliminarImagen(imgId);
        });
    });

    function subirImagenes(files) {
        const casaId = $('#casa_id').val();
        if (!casaId) {
            Swal.fire('Error', 'No se ha seleccionado una casa', 'error');
            return;
        }
        
        const formData = new FormData();
        formData.append('casa_id', casaId);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Validar cada archivo antes de agregarlo
        let hasErrors = false;
        Array.from(files).forEach((file, index) => {
            if (file.size > 5 * 1024 * 1024) {
                $('#imageUploadError').text(`El archivo ${file.name} es demasiado grande (Máx. 5MB)`).show();
                hasErrors = true;
                return;
            }
            
            if (!file.type.match('image.*')) {
                $('#imageUploadError').text(`El archivo ${file.name} no es una imagen válida`).show();
                hasErrors = true;
                return;
            }
            
            formData.append(`images[${index}]`, file);
        });
        
        if (hasErrors) return;
        
        $('#imageUploadError').hide();
        
        $.ajax({
            url: '{{ route("subirImagenes") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                // Mostrar indicador de carga
                $('#imageDropzone').html('<div class="text-center py-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2 mb-0">Subiendo imágenes...</p></div>');
            },
            success: function(response) {
                // Recargar la galería
                cargarImagenesCasa(casaId);
                
                // Restaurar el dropzone
                $('#imageDropzone').html(`
                    <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" style="display:none;">
                    <div class="dz-message">
                        <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                        <p class="mb-0">Arrastra imágenes aquí o haz clic para seleccionar</p>
                        <small class="text-muted">Formatos: JPG, PNG (Máx. 5MB cada una)</small>
                    </div>
                `);
                
                Swal.fire('Éxito', 'Imágenes subidas correctamente', 'success');
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Error al subir imágenes', 'error');
                
                // Restaurar el dropzone
                $('#imageDropzone').html(`
                    <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" style="display:none;">
                    <div class="dz-message">
                        <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                        <p class="mb-0">Arrastra imágenes aquí o haz clic para seleccionar</p>
                        <small class="text-muted">Formatos: JPG, PNG (Máx. 5MB cada una)</small>
                    </div>
                `);
            }
        });
    }

    function eliminarImagen(imgId) {
        Swal.fire({
            title: '¿Eliminar imagen?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("eliminarImagen") }}',
                    type: 'POST',
                    data: {
                        img_id: imgId,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $(`[data-img-id="${imgId}"]`).css('opacity', '0.5');
                    },
                    success: function(response) {
                        $(`[data-img-id="${imgId}"]`).remove();
                        Swal.fire('Eliminada', 'La imagen ha sido eliminada', 'success');
                    },
                    error: function(xhr) {
                        $(`[data-img-id="${imgId}"]`).css('opacity', '1');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Error al eliminar la imagen', 'error');
                    }
                });
            }
        });
    }

    const dropzone = $('#imageDropzone');
    const fileInput = $('<input type="file" id="imageUpload" multiple accept="image/*" style="display:none">');
    $('body').append(fileInput);
    
    // Elimina cualquier input file duplicado
    $('#imageUpload').not(':last').remove();
    
    dropzone.on('click', function(e) {
        if (!$(e.target).is('input')) {
            fileInput.trigger('click');
        }
    });
    
    fileInput.on('change', function(e) {
        if (this.files && this.files.length > 0) {
            const files = Array.from(this.files);
            subirImagenes(files);
            
            // Recrear el input para evitar problemas
            fileInput.remove();
            fileInput = $('<input type="file" id="imageUpload" multiple accept="image/*" style="display:none">');
            $('body').append(fileInput);
            setupFileInputEvents();
        }
    });
    
    function setupFileInputEvents() {
        fileInput.on('change', function(e) {
            if (this.files && this.files.length > 0) {
                const files = Array.from(this.files);
                subirImagenes(files);
                
                fileInput.remove();
                fileInput = $('<input type="file" id="imageUpload" multiple accept="image/*" style="display:none">');
                $('body').append(fileInput);
                setupFileInputEvents();
            }
        });
    }

    
});
    
    
</script>

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

    <script>
      $(document).ready(function() {
            // Inicializar Summernote con validación mejorada
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function() {
                        validateSummernote();
                    },
                    onInit: function() {
                        // Validar inicialmente
                        validateSummernote();
                    }
                }
            });

            // Función mejorada para validar Summernote
            function validateSummernote() {
                const content = $('#casa_descripcion').summernote('code');
                const isEmpty = !content || 
                            content.trim() === '' || 
                            content === '<p><br></p>' || 
                            content === '<p></p>' ||
                            content === '<p>&nbsp;</p>';
                
                if (isEmpty) {
                    $('#casa_descripcion').addClass('is-invalid');
                    $('.note-editor').addClass('border-danger');
                    $('.note-editor').removeClass('border-success');
                    return false;
                } else {
                    $('#casa_descripcion').removeClass('is-invalid');
                    $('.note-editor').removeClass('border-danger');
                    $('.note-editor').addClass('border-success');
                    return true;
                }
            }

            // Vista previa de la imagen
            $('#casa_logo').change(function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    
                    if (file.size > 2 * 1024 * 1024) {
                        $(this).addClass('is-invalid');
                        $('#logoPreviewContainer').hide();
                        Swal.fire('Error', 'El archivo es demasiado grande (Máx. 2MB)', 'error');
                        return;
                    }
                    
                    if (!file.type.match('image.*')) {
                        $(this).addClass('is-invalid');
                        $('#logoPreviewContainer').hide();
                        Swal.fire('Error', 'Solo se permiten imágenes (JPG, PNG)', 'error');
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logoPreview').attr('src', e.target.result);
                        $('#logoPreviewContainer').show();
                        $(this).removeClass('is-invalid');
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });

            // Envío del formulario con AJAX
            $('#formNuevaCasa').submit(function(e) {
                e.preventDefault();
                
                // Validar Summernote primero
                if (!validateSummernote()) {
                    Swal.fire({
                        title: 'Error',
                        text: 'La descripción es obligatoria',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                    $('html, body').animate({
                        scrollTop: $('#casa_descripcion').offset().top - 100
                    }, 500);
                    return;
                }
                
                // Validar otros campos
                let isValid = true;
                $(this).find('[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                        
                        // Scroll al primer error
                        if (isValid === false) {
                            $('html, body').animate({
                                scrollTop: $(this).offset().top - 100
                            }, 500);
                            isValid = null; // Solo hacemos scroll una vez
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!isValid) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor complete todos los campos obligatorios',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }
                
                // Obtener el contenido HTML de Summernote
                const descripcionHtml = $('#casa_descripcion').summernote('code');
                
                // Crear objeto FormData
                const formData = new FormData(this); // Usamos el formulario directamente
                
                // Actualizar la descripción con el contenido de Summernote
                formData.set('casa_descripcion', descripcionHtml);
                
                // Agregar el campo casa_activo
                formData.set('casa_activo', $('#casa_activo').is(':checked') ? '1' : '0');
                
                // Enviar por AJAX con CSRF token
                $.ajax({
                    url: $(this).attr('action') || "{{ route('nuevaCasa') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Procesando',
                            html: 'Guardando información de la casa...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            $('#nuevaCasaModal').modal('hide');
                            
                            // Recargar la página o actualizar la tabla
                            if (result.isConfirmed) {
                                // Redirigir a la vista de detalles
                                window.location.href = response.redirect_url;
                            } else {
                                // Recargar la página si no quiere ver detalles
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        let errorMessage = 'Error al guardar la casa';
                        
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value + '<br>';
                            });
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire({
                            title: 'Error',
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    }
                });
            });

            // Limpiar el modal al cerrar
            $('#nuevaCasaModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.summernote').summernote('reset');
                $('#logoPreviewContainer').hide();
                $('.is-invalid').removeClass('is-invalid');
                $('.note-editor').removeClass('border-danger border-success');
            });
        });
    </script>

</body>
</html>