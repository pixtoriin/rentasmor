<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resumen de Notificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --blueInstitucional: #092D39;
            --border-width: 0.4rem;
            --border-style: solid;
            --border-color: #7299d9;
        }

        body {
            background-color: #f3f3f3;
            font-family: "Quicksand", serif;
        }

        .shadow {
            box-shadow: 0 0.1rem 0.1rem rgba(0, 0, 0, 0.2) !important;
        }

        .border-15 {
            border-radius: 15px !important;
        }

        .swiperCarrusel {
            padding: 0 0 2rem 0 !important;
        }

        .swiperCarrusel .swiper-slide {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .swiperCarrusel .swiper-slide img {
            width: 100%;
            aspect-ratio: 0.7 / 0.9;
            object-fit: cover;
            height: auto;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(255, 255, 255, 1);
            color: #565656;
            text-align: left;
            padding: 10px 20px;
            font-size: 11px;
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr auto;
            align-items: center;
            min-height: 50px;
        }

        .footer .event-info {
            display: flex;
            align-items: center;
        }

        .footer .event-info i {
            margin-right: 8px;
            font-size: 11px;
        }

        .footer .icono {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .footer .icono i {
            margin-right: 5px;
            font-size: 16px;
        }

        .swiperCarrusel .swiper-button-prev, .swiper-button-next {
            color: #003b6a;
            font-size: 50px;
        }

        .swiperCarrusel .swiper-pagination {
            bottom: -10px;
        }

        .swiperCarrusel .swiper-pagination-progressbar {
            top: auto !important;
            bottom: 0 !important;
        }

        .swiperCarrusel .swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
            background: var(--blueInstitucional) !important;
        }

        .titulo-blue {
            color: var(--blueInstitucional) !important;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .pagination, .jsgrid .jsgrid-pager {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
            flex-wrap: wrap;
        }

        .page-link {
            color: var(--blueInstitucional) !important;
        }

        .color-icon {
            color: var(--blueInstitucional) !important;
        }

        .border-azul {
            border: var(--bs-border-width) solid var(--blueInstitucional) !important;
        }

        .pagination-rounded-flat .page-item {
            margin: 0 .25rem;
        }

        .pagination-success .page-item .page-link {
            background: white;
            border-color: var(--blueInstitucional) !important;
        }

        .pagination .page-item .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: var(--blueInstitucional) !important;
            color: white !important;
        }

        .pagination-rounded-flat .page-item .page-link {
            border: none;
            border-radius: 7px;
        }

        @media (max-width: 576px) {
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-item {
                flex: 1;
                min-width: 40px;
                text-align: center;
            }
        }

        .imagen-Lista {
            aspect-ratio: 1 / 1;
            object-fit: cover;
            width: 64px;
            height: 64px;
        }

        .navbar-custom {
            background-color: #fff !important;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-toggle {
            color: var(--blueInstitucional) !important;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .dropdown-toggle:hover {
            color: #0072cd !important;
        }

        .navbar-custom .dropdown-menu {
            background-color: var(--blueInstitucional) !important;
        }

        .navbar-custom .dropdown-item {
            color: white !important;
        }

        .navbar-custom .dropdown-item:hover {
            background-color: #0072cd !important;
            color: #fff !important;
        }

        .navbar-custom .form-control {
            background-color: white !important;
            color: black !important;
            border-color: var(--blueInstitucional) !important;
        }

        .navbar-custom .input-group-text {
            color: #fff !important;
            border-color: var(--blueInstitucional) !important;
            background-color: var(--blueInstitucional) !important;
        }

        .navbar-custom .input-group-text:hover {
            background-color: #0072cd !important;
            border-color: #0072cd !important;
            color: #fff !important;
        }

        .quitarBorderDerecha {
            border-radius: 0px !important;
            border-top-right-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
        }

        .quitarBorderIzquierda {
            border-radius: 0px !important;
            border-top-left-radius: 15px !important;
            border-bottom-left-radius: 15px !important;
        }

        .custom-footer {
            background-color: #fff;
            color: var(--blueInstitucional) !important;
        }

        .custom-footer a {
            font-size: 1.2rem;
            color: var(--blueInstitucional) !important;
        }

        .custom-footer a:hover {
            color: #ffffff;
        }

        .hero {
            display: grid;
            position: relative;
            grid-template-columns: 100vw;
            grid-template-rows: 100vh;
            place-items: center;
            overflow: hidden;
            will-change: clip-path;
            animation: fade-in 0.8s linear;
        }

        .hero__bg,
        .hero__cnt {
            align-self: center;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }

        .hero__bg {
            display: grid;
            position: relative;
            z-index: 0;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr;
            place-items: center;
            background-attachment: fixed;
            animation: fade-in 0.75s linear;
            will-change: opacity;
        }

        .hero__bg::before {
            content: "";
            display: block;
            position: absolute;
            z-index: 5;
            top: -10%;
            right: -10%;
            bottom: -10%;
            left: -10%;
            background: rgba(41, 4, 47, 0.4);
            background-blend-mode: screen;
        }

        .hero__bg picture {
            display: flex;
            height: 100vh;
            width: 100vw;
            animation: scaling-hero-anim 4s 0.25s cubic-bezier(0, 0.71, 0.4, 0.97) forwards;
            will-change: transform;
        }

        .hero__bg img {
            display: block;
            object-fit: cover;
            object-position: 77% 50%;
            height: auto;
            width: 100%;
        }

        .hero__cnt {
            display: grid;
            position: relative;
            place-items: center;
            z-index: 10;
            color: #FFF;
            font-size: 2.5vw;
            text-transform: uppercase;
            opacity: 0;
            animation: fade-in 0.75s 0.6s linear forwards;
        }

        .hero__cnt svg {
            height: 12vw;
        }

        .hero__cnt svg path {
            fill: #FFF;
        }

        .hero__cnt h1 {
            margin-bottom: 0;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes scaling-hero-anim {
            from {
                transform: scale(1.25);
            }
            to {
                transform: scale(1.1);
            }
        }

        @keyframes clip-hero-anim {
            from {
                clip-path: polygon(50% 50%, 50% 50%, 50% 50%, 50% 50%);
            }
            to {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
            }
        }

        .hero-nav {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            min-height: 7.5vh;
            background-image: url('https://editorialtelevisa.brightspotcdn.com/dims4/default/2796cee/2147483647/strip/true/crop/1199x675+1+0/resize/1000x563!/quality/90/?url=https%3A%2F%2Fk2-prod-editorial-televisa.s3.us-east-1.amazonaws.com%2Fbrightspot%2Ff1%2F5d%2F2b14e9f84b72855f422b95cba897%2Fcuernavaca-1200x675.jpg');
            background-size: cover;
            background-position: center;
            overflow: hidden;
            z-index: 1000;
            place-items: center;
            animation: fade-in 0.8s linear;
            will-change: opacity;
        }

        .hero-nav .hero-nav__inner {
            z-index: 1000;
            align-self: center;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }

        .hero-nav .hero-nav__inner {
            display: grid;
            position: relative;
            place-items: center;
            z-index: 10;
            color: var(--white);
            font-size: 3vw;
            text-transform: uppercase;
            opacity: 0;
            animation: fade-in 0.75s 0.6s linear forwards;
        }

        .hero-nav .hero-nav__inner h1 {
            margin-bottom: 0;
            color: #efefef;
        }

        .hero-nav::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(41, 4, 47, 0.4);
            background-blend-mode: screen;
        }

        .hero-nav.fixme::before {
            background: rgba(41, 4, 47, 0.4);
            background-blend-mode: screen;
        }

        .page-content {}

        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes clip-hero-anim {
            from {
                clip-path: polygon(50% 50%, 50% 50%, 50% 50%, 50% 50%);
            }
            to {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
            }
        }

        .border-Hero-Bottom {
            border-bottom: var(--border-width) var(--border-style) var(--border-color) !important;
        }

        .hero-nav__button {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            z-index: 10;
            color: var(--white);
            font-size: clamp(16px, 3vw, 20px);
            text-transform: uppercase;
            opacity: 0;
            animation: fade-in 0.75s 0.6s linear forwards;
            margin-top: 30rem;
        }

        .hero-nav__button a {
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .hero-nav__button {
                font-size: 13px;
                margin-top: 30rem;
            }

            .custom-img-hero {
                margin-bottom: 15rem;
            }
        }

        .modal-header-custom {
            position: relative;
            min-height: 30px;
            overflow: hidden;
        }

        .modal-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--blueInstitucional);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            transform: scaleX(-1);
        }

        .modal-header-custom .texto-header {
            position: relative;
            line-height: 20px;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            z-index: 1;
        }

        .modal-header-custom .btn-close {
            color: rgba(255, 0, 0, 0.7);
        }

        .custom-close-btn {
            filter: drop-shadow(0 0 2px red);
        }

        .btn-filter {
            background-color: var(--blueInstitucional) !important;
            color: white !important;
        }

        .btn-filter:hover {
            background-color: white !important;
            color: var(--blueInstitucional) !important;
            filter: drop-shadow(0 0 2px var(--blueInstitucional));
        }

        .btn-close {
            --bs-btn-close-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ff0000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") !important;
        }

        .modal-content-custom {
            background-color: #f3f3f3 !important;
        }

        .card-custom-white {
            background-color: #fff !important;
            border: var(--bs-border-width) solid var(--bs-border-color-translucent) !important;
        }

        .nav-tabs-custom {
            --bs-nav-tabs-link-active-border-color: var(--blueInstitucional) var(--blueInstitucional) var(--bs-body-bg) !important;
            border-bottom: var(--bs-nav-tabs-border-width) solid var(--blueInstitucional) !important;
            --bs-nav-tabs-border-width: 2px !important;
        }

        .icono-cuadro {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4vh;
            height: 4vh;
            background-color: var(--blueInstitucional) !important;
            border-radius: 1rem
        }

        .row-custom {
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

        .row-custom div i {
            color: var(--blueInstitucional) !important;
        }

        .row-custom div .icono-cuadro i {
            color: white !important;
        }

        .nav-tabs .nav-link.active {
            font-weight: 500;
            color: var(--blueInstitucional);
            background-color: var(--bs-nav-tabs-link-active-bg);
            border-color: var(--bs-nav-tabs-link-active-border-color);
        }

        .a-ligas {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
        }

        .a-ligas:hover {
            text-decoration: underline;
        }

        #main {
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .container-pr-custom {
            padding-right: calc(var(--bs-gutter-x)* .5);
        }

        .custom-rentasDirectas {
            font-family: "Quicksand", serif;
            font-weight: 700;
        }

        .custom-text {
            font-size: 15px;
            margin-bottom: 0;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            font-family: "Quicksand", serif;
            font-style: italic;
            text-transform: none;
        }

        .custom-img-hero {
            margin-bottom: 25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
        }

        @media (max-width: 768px) {
            .hero-nav__button {
                font-size: 13px;
                margin-top: 30rem;
            }

            .custom-img-hero {
                margin-bottom: 15rem;
            }
        }

        .container-hover {
            transition: all 0.1s ease-in-out;
            cursor: pointer;
        }

        .container-hover:hover {
            box-shadow: 0px 4px 0px var(--blueInstitucional);
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        .fullscreen-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            overflow: hidden;
        }

        .fullscreen-img {
            max-width: 100%;
            max-height: 100%;
            cursor: zoom-in;
            transform-origin: center center;
            transition: transform 0.2s ease-out;
            position: absolute;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--blueInstitucional) !important;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 20%;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            z-index: 10000;
        }

        .close-btn:hover {
            background-color: white;
            color: red;
        }

        .close-btn i {
            font-size: 20px;
        }

        .grabbing {
            cursor: grabbing !important;
        }
    </style>

    <script>
        window.addEventListener('scroll', function () {
            const heroBg = document.querySelector('.hero__bg');
            const scrollPosition = window.scrollY;
            heroBg.style.transform = 'translateY(' + scrollPosition * 0.3 + 'px)';
        });

        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll(".zoomable-img");
            const modal = document.getElementById("exampleModal");

            images.forEach(img => {
                img.addEventListener("click", function (event) {
                    event.stopPropagation();
                    modal.style.display = "none";
                    showFullscreen(this, event);
                });
            });

            function showFullscreen(imgElement, event) {
                const fullscreenContainer = document.createElement("div");
                fullscreenContainer.classList.add("fullscreen-container");

                const fullscreenImg = document.createElement("img");
                fullscreenImg.src = imgElement.src;
                fullscreenImg.classList.add("fullscreen-img");

                const closeButton = document.createElement("button");
                closeButton.classList.add("btn", "btn-link", "close-btn");
                closeButton.innerHTML = '<i class="bi bi-x-lg"></i>';
                closeButton.addEventListener("click", function () {
                    fullscreenContainer.remove();
                    modal.style.display = "block";
                });

                fullscreenContainer.appendChild(fullscreenImg);
                fullscreenContainer.appendChild(closeButton);
                document.body.appendChild(fullscreenContainer);

                let scale = 1;
                let imgX = 0, imgY = 0;
                let isDragging = false, startX, startY;

                function updateTransform() {
                    fullscreenImg.style.transform = `translate(${imgX}px, ${imgY}px) scale(${scale})`;
                }

                fullscreenImg.addEventListener("click", function (event) {
                    const rect = fullscreenImg.getBoundingClientRect();
                    const offsetX = event.clientX - rect.left;
                    const offsetY = event.clientY - rect.top;

                    if (scale === 1) {
                        scale = 2.5;
                        fullscreenImg.style.cursor = "zoom-out";
                        imgX = (rect.width / 2 - offsetX) * (scale - 1);
                        imgY = (rect.height / 2 - offsetY) * (scale - 1);
                    } else {
                        scale = 1;
                        imgX = 0;
                        imgY = 0;
                        fullscreenImg.style.cursor = "zoom-in";
                    }
                    updateTransform();
                });

                fullscreenContainer.addEventListener("wheel", function (event) {
                    event.preventDefault();
                    const zoomIntensity = 0.2;
                    const rect = fullscreenImg.getBoundingClientRect();
                    const offsetX = event.clientX - rect.left;
                    const offsetY = event.clientY - rect.top;

                    let newScale = scale + (event.deltaY > 0 ? -zoomIntensity : zoomIntensity);
                    newScale = Math.max(1, Math.min(newScale, 4));

                    if (newScale !== scale) {
                        imgX = (rect.width / 2 - offsetX) * (newScale - 1);
                        imgY = (rect.height / 2 - offsetY) * (newScale - 1);
                        scale = newScale;
                        updateTransform();
                    }
                });

                fullscreenImg.addEventListener("mousedown", function (event) {
                    if (scale > 1) {
                        isDragging = true;
                        startX = event.clientX - imgX;
                        startY = event.clientY - imgY;
                        fullscreenImg.classList.add("grabbing");
                    }
                });

                window.addEventListener("mousemove", function (event) {
                    if (isDragging) {
                        imgX = event.clientX - startX;
                        imgY = event.clientY - startY;
                        updateTransform();
                    }
                });

                window.addEventListener("mouseup", function () {
                    isDragging = false;
                    fullscreenImg.classList.remove("grabbing");
                });

                document.addEventListener("keydown", function (event) {
                    if (event.key === "Escape") {
                        fullscreenContainer.remove();
                        modal.style.display = "block";
                    }
                });
            }
        });
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
    <div class="hero">
        <div class="hero__bg">
            <picture>
                <img src="{{ asset('imagenes/atardecer02.jpg') }}">
            </picture>
        </div>

        <div class="hero__cnt">
            <img class="custom-img-hero" src="{{ asset('imagenes/LogoRD.svg') }}" fill="white" alt="Logo UAEM">
            <h1 class="custom-rentasDirectas">RENTAS DIRECTAS</h1>
            <p class="custom-text">Tu comodidad es nuestra prioridad</p>
            <div class="hero-nav__button">
                <a href="#main">Ver más<i class="bi bi-chevron-double-down"></i></a>
            </div>
        </div>
    </div>

    <div class="container mt-4 page-content">

        <div class="row mb-3" id="main">
            <nav class="navbar navbar-expand-lg navbar-custom shadow border-15">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img style="width: 125px;" src="{{ asset('imagenes/LogoRentasDirectas.svg') }}" alt="logo-uaem">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="desDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    DES
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="desDropdown">
                                    <li><a class="dropdown-item" href="#">Agropecuarias</a></li>
                                    <li><a class="dropdown-item" href="#">Artes, Cultura y Diseño</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="unidadesDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Unidades Académicas
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="unidadesDropdown">
                                    <li><a class="dropdown-item" href="#">Facultad de Ciencias Agropecuarias</a></li>
                                    <li><a class="dropdown-item" href="#">Facultad de Artes</a></li>
                                </ul>
                            </li>

                            <li class="nav-item" style="border-right: 1px solid #ddd; margin-right: 10px; margin-left: 10px;"></li>
                            <li class="nav-item"><a class="nav-link" href="#">Avisos</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Talleres</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Convocatorias</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="otrosDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Otros
                                </a>
                            </li>
                        </ul>

                        <form class="d-flex border-15">
                            <div class="input-group border-15">
                                <input class="form-control quitarBorderIzquierda" type="search" placeholder="Buscar casa" aria-label="Buscar">
                                <span class="input-group-text quitarBorderDerecha">
                                    <i class="bi bi-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="row align-items-center mb-3">
            <div class="col-md-8">
                <h2 class="titulo-blue">Casas Disponibles</h2>
                <p class="text-muted">{{ $fecha }}</p>
            </div>
            <div class="col-md-4 text-md-end mt-1 mt-md-0 d-none d-md-block">
                <div class="d-inline-flex align-items-center p-2 shadow border-15" style="background: white;">
                    <img src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="Soleado" width="30">
                    <div class="ms-2">
                        <small class="text-muted">Cuernavaca</small>
                        <h5 class="mb-0">{{ $temperature }} °C</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 mt-3">
            <div class="col-md-12">
                <div class="swiperCarrusel swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide shadow border-15">
                            <img src="https://images.unsplash.com/photo-1602343168117-bb8ffe3e2e9f?q=80&w=1450&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Imagen 1">
                            <div class="footer">
                                <div class="event-info">
                                    <div class="icono">
                                        <i class="bi bi-house-fill"></i> Casa Verde
                                    </div>
                                </div>
                                <div class="icono">
                                    <i class="bi bi-geo-alt-fill"></i> Jiutepec, Mor.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide shadow border-15">
                            <img src="https://images.unsplash.com/photo-1598714805247-5dd440d87124?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Imagen 1">
                            <div class="footer">
                                <div class="event-info">
                                    <div class="icono">
                                        <i class="bi bi-house-fill"></i> Casa Liz
                                    </div>
                                </div>
                                <div class="icono">
                                    <i class="bi bi-geo-alt-fill"></i> Jiutepec, Mor.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide shadow border-15">
                            <img src="https://plus.unsplash.com/premium_photo-1661876449499-26de7959878f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Imagen 1">
                            <div class="footer">
                                <div class="event-info">
                                    <div class="icono">
                                        <i class="bi bi-house-fill"></i> Bungalow Sicilia
                                    </div>
                                </div>
                                <div class="icono">
                                    <i class="bi bi-geo-alt-fill"></i> Temixco, Mor.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide shadow border-15">
                            <img src="{{ asset('imagenes/imagenesCasaNazomi/casa_nozomi.jpg') }}" alt="Imagen 1">
                            <div class="footer">
                                <div class="event-info">
                                    <div class="icono">
                                        <i class="bi bi-house-fill"></i> Casa Nozomi
                                    </div>
                                </div>
                                <div class="icono">
                                    <i class="bi bi-geo-alt-fill"></i> Jiutepec, Mor.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8">
                <div class="card p-3 border-15 shadow">
                    <div class="d-flex justify-content-between align-items-center container-pr-custom">
                        <h4 class="titulo-blue">Catálogo de Casas</h4>
                        <button type="button" class="btn btn-filter" data-bs-toggle="modal" data-bs-target="#fechaModal">
                            <i class="bi bi-calendar2-plus-fill"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="container container-hover" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="row">
                            <div class="col-9 col-md-9">
                                <h6 class="text-muted"><i class="bi bi-house-fill"></i> Finca Jiutepec</h6>
                                <h6 class="mb-1"><i class="bi bi-currency-exchange"></i> $2000.00 MXN / Noche</h6>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt-fill"></i> Jiutepec, Mor.
                                </small>
                            </div>
                            <div class="col-3 col-md-3 text-end">
                                <img src="{{ asset('imagenes/imagenesFincaJiutepec/1_FincaJiutepec.jpg') }}" class="img-fluid rounded imagen-Lista" alt="Aviso">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container-fluid mt-3">
                        <nav class="text-center">
                            <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                                <li class="page-item">
                                    <a class="page-link shadow" href="#" data-abc="true"><i class="bi bi-arrow-bar-left"></i></a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link shadow" href="#" data-abc="true">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link shadow" href="#" data-abc="true">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link shadow" href="#" data-abc="true">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link shadow" href="#" data-abc="true">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link shadow" href="#" data-abc="true"><i class="bi bi-arrow-bar-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 border-15 shadow mt-3 mt-md-0">
                    <h4 class="titulo-blue">Avisos importantes</h4>
                    <hr>
                    <div class="container container-hover">
                        <div class="row align-items-center">
                            <div class="col-9 col-md-9">
                                <h6 class="text-muted">Fraudes y Estafas</h6>
                                <h6 class="mb-1">Reporta comportamientos sospechosos para garantizar tu seguridad.</h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar4-week"></i>&ensp;15 / Febrero / 2025
                                </small>
                            </div>
                            <div class="col-3 col-md-3 text-md-end text-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/10135/10135431.png" alt="Fraude" class="img-fluid rounded imagen-Lista">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container container-hover">
                        <div class="row align-items-center">
                            <div class="col-9 col-md-9">
                                <h6 class="text-muted">Nuevo reglamento de casas</h6>
                                <h6 class="mb-1">Respeta el reglamento para una estancia agradable.</h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar4-week"></i>&ensp;01 / Enero / 2025
                                </small>
                            </div>
                            <div class="col-3 col-md-3 text-md-end text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="container-fluid custom-footer py-3 shadow border-15">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start">
                        <b>© 2025 · Desarrollado por · Victor Diaz Medina</b>
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        <a href="#" class="mx-2"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title texto-header" id="cursoModalLabel">CASA VERDE | Jiutepec, Mor.</h5>
                    <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="row row-custom mt-3 p-2 card-custom-white p-3 shadow border-1 mt-3">
                                <h4><b>FINCA JIUTEPEC</b></h4>
                                <h6 class="pb-3">Jiutepec, Mor.</h6>

                                <p class="text-break">
                                    <p>📍Ubicada en el fraccionamiento Las Fincas (Jiutepec Morelos), cuenta con seguridad 24 horas,&nbsp;</p><p>El fraccionamiento cuenta con canchas de futbol, tenis, y muchos jardines que pertenecen al fraccionamiento, a 03 minutos en coche, encuentras tiendas de todo tipo como: abarrotes, carnicerías, pollerías, Oxxo, farmacia etc.,&nbsp;</p><p><br></p><p>👨‍👩‍👧‍👦 Capacidad 32 huéspedes en camas.&nbsp;</p><p>🚘 Garaje para 05 coches, (pueden estacionarse más coches sobre la calle de manera segura por la vigilancia del fraccionamiento).&nbsp;</p><p>🛋️ Estancia muy amplia con sala, pantalla con cable y chimenea.&nbsp;</p><p>🏓 Sala de juegos con mesa de billar y mesa de Ping pong.</p><p>🍳Cocina muy amplia con estufa industrial, accesorios para cocinar y comer.</p><p>🪑La casa cuenta con 02 comedores uno en la cocina y otro en la estancia.</p><p>⛱️ Mobiliario de jardín mesas, sillas, camastros, sombrillas.&nbsp;</p><p>🥩 Zona exterior de asador con barra y fregadero.&nbsp;</p><p>🌊 Alberca con jacuzzi, (cuenta con caldera de gas con costo extra).&nbsp;</p><p>💻 Internet de alta velocidad.&nbsp;</p><p>🛝 Área de juegos para niños</p><p>Contamos con corral y cuna de viaje&nbsp;&nbsp;</p><p><br></p><p>&nbsp;Son 06 habitaciones en total:</p><p><b>~(Planta alta)</b></p><p>🛏️ Habitación principal: 4 camas matrimonial, 01 sofá cama matrimonial, baño completo y closet.&nbsp;</p><p>🛏️ Habitación 02: 02 camas matrimoniales, 01 cama individual, baño completo, closet.&nbsp;</p><p>🛏️ Habitación 03: 01 cama king size, cuna infantil, baño completo, clóset.&nbsp;</p><p>🛏️ Habitación 04: 3 camas individuales, 1 cama matrimonial, 1 sofá-cama individual, baño completo, clóset.&nbsp;</p><p><br></p><p><b>~(Planta baja)</b></p><p>🛏️ Habitación 05: 02 camas matrimoniales, 01 cama individual.&nbsp;</p><p>🛏️ Habitación 06: 1 cama King, 1 cama individual&nbsp;</p><p>🚽 Medio baño compartido para estas 02 habitaciones de planta baja.</p><p>🚽2 Baños completos en la zona de la alberca.&nbsp;</p><p>👀 La casa se entrega completamente organizada, limpia y fumigada.</p><p>🧼🧻🧺 Se pone jabón, Shampo, papel higiénico y toallas dependiendo la cantidad de huéspedes.&nbsp;</p><p>🐶 Aceptamos Mascotas medianas.&nbsp;</p><p>📆 Temporada baja mínimo 02 noches,</p><p>Temporada alta mínimo 04 noches.</p>
                                </p>
                            </div>

                            <div class="row row-custom mt-3 p-2 card-custom-white shadow border-1" style="place-items: end;">
                                <div class="col-12 col-md-4">
                                    <i class="bi bi-calendar-week"></i> Verifica: <a class="a-ligas" href="" target="_blank"> disponibilidad</a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <i class="bi bi-whatsapp"></i> Reserva: <a class="a-ligas" href="https://wa.me/527774432521?text=Hola,%20quiero%20hacer%20una%20reserva" target="_blank"> vía WhatsApp</a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <i class="bi bi-telephone-forward"></i> Informes: <a class="a-ligas" href="tel:+527774432521">llamar ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fechaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title texto-header" id="fechaModalLabel">Filtrado por Fechas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="fechaModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group d-flex">
                        <span class="input-group-text color-icon border-azul">
                            <i class="bi bi-calendar2-week"></i>
                        </span>
                        <input id="fechas" name="fechas" class="form-control BusqInf flatpickr-input border-azul"
                            type="text" placeholder="Seleccione un rango de fechas">
                        <button class="btn btn-filter" type="button">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        config = {
            mode: "range",
            inline: false,
            maxDate: "today",
            altInput: true,
            altFormat: "l j, F",
            dateFormat: "Y-m-d",
            language: 'es',
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                        'Octubre', 'Noviembre', 'Diciembre'
                    ],
                },
            }
        }
        flatpickr("#fechas", config);
    </script>

    <script>
        var swiperCarrusel = new Swiper('.swiperCarrusel', {
            loop: true,
            autoplay: {
                delay: 300000,
                disableOnInteraction: false
            },
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: "progressbar",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },

        });
    </script>
    <script>
        var swiperCards;

        $('#exampleModal').on('shown.bs.modal', function () {
            swiperCards = new Swiper(".swiperCards", {
                effect: "cards",
                grabCursor: true,
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function () {
            if (swiperCards) {
                swiperCards.destroy();
            }
        });
    </script>
</body>
</html>