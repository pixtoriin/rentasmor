<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Casa - Rentas Directas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .detail-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            border: none;
        }
        .detail-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 1.5rem;
        }
        .detail-img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 8px;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .detail-img:hover {
            transform: scale(1.03);
        }
        .info-table th {
            background-color: #f8f9fa;
            width: 30%;
        }
        .description-box {
            background-color: #f8f9fa;
            border-left: 4px solid #6a11cb;
            padding: 1rem;
            border-radius: 5px;
        }
        .action-btn {
            min-width: 120px;
        }
        .badge-active {
            background-color: #28a745;
        }
        .badge-inactive {
            background-color: #dc3545;
        }
        @media (max-width: 768px) {
            .detail-img-container {
                text-align: center;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="detail-card card">
                    <!-- Encabezado -->
                    <div class="detail-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0"><i class="fas fa-home me-2"></i> Detalles de la Casa</h2>
                            <a href="lista_casas.html" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Cuerpo -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <!-- Columna Imagen -->
                            <div class="col-md-4 detail-img-container">
                                <img src="https://ejemplo.com/ruta/logo_casa.jpg" alt="Logo de la casa" class="detail-img" id="casa-logo">
                                <h3 class="text-center mt-3 text-primary" id="casa-nombre">Casa Azul</h3>
                            </div>

                            <!-- Columna Información -->
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table info-table">
                                        <tbody>
                                            <tr>
                                                <th>Propietario</th>
                                                <td id="casa-propietario">Juan Pérez</td>
                                            </tr>
                                            <tr>
                                                <th>Dirección</th>
                                                <td id="casa-direccion">Calle Primavera #123, Col. Centro</td>
                                            </tr>
                                            <tr>
                                                <th>Municipio</th>
                                                <td id="casa-municipio">Cuernavaca</td>
                                            </tr>
                                            <tr>
                                                <th>Precio por noche</th>
                                                <td id="casa-precio">$1,500.00 MXN</td>
                                            </tr>
                                            <tr>
                                                <th>Teléfono</th>
                                                <td id="casa-telefono">777-123-4567</td>
                                            </tr>
                                            <tr>
                                                <th>Estado</th>
                                                <td>
                                                    <span class="badge badge-active" id="casa-estado">Activa</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-align-left me-2"></i>Descripción</h5>
                            </div>
                            <div class="card-body description-box" id="casa-descripcion">
                                Hermosa casa ubicada en el corazón de la ciudad, con amplios jardines, 3 recámaras, 2 baños completos, cocina equipada y alberca. Ideal para vacaciones familiares o reuniones con amigos.
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex justify-content-end">
                            <a href="editar_casa.html?id=1" class="btn btn-warning action-btn me-2">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <button class="btn btn-danger action-btn" onclick="confirmarEliminacion()">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 para confirmación -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Esta función se encargaría de cargar los datos reales cuando la página se cargue
        function cargarDatosCasa() {
            // En una implementación real, aquí harías una petición AJAX o usarías
            // datos pasados desde el servidor para llenar la información
            
            // Ejemplo de cómo se llenarían los datos dinámicamente:
            /*
            fetch('/api/casas/' + obtenerIdDeURL())
                .then(response => response.json())
                .then(data => {
                    document.getElementById('casa-nombre').textContent = data.casa_nombre;
                    document.getElementById('casa-logo').src = data.casa_logo;
                    document.getElementById('casa-propietario').textContent = data.casa_propietario;
                    document.getElementById('casa-direccion').textContent = data.casa_direccion;
                    document.getElementById('casa-municipio').textContent = data.casa_municipio;
                    document.getElementById('casa-precio').textContent = '$' + parseFloat(data.casa_precioxnoche).toFixed(2);
                    document.getElementById('casa-telefono').textContent = data.casa_telefono;
                    document.getElementById('casa-descripcion').innerHTML = data.casa_descripcion;
                    
                    const estadoBadge = document.getElementById('casa-estado');
                    if (data.casa_activo) {
                        estadoBadge.textContent = 'Activa';
                        estadoBadge.className = 'badge badge-active';
                    } else {
                        estadoBadge.textContent = 'Inactiva';
                        estadoBadge.className = 'badge badge-inactive';
                    }
                });
            */
        }

        function confirmarEliminacion() {
            Swal.fire({
                title: '¿Eliminar esta casa?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí iría la lógica para eliminar la casa
                    // Por ejemplo:
                    /*
                    fetch('/api/casas/' + obtenerIdDeURL(), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.href = 'lista_casas.html';
                        }
                    });
                    */
                    
                    // Solo para demostración:
                    Swal.fire(
                        '¡Eliminada!',
                        'La casa ha sido eliminada.',
                        'success'
                    ).then(() => {
                        window.location.href = 'lista_casas.html';
                    });
                }
            })
        }

        // Función para obtener el ID de la URL
        function obtenerIdDeURL() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Cuando la página cargue, obtenemos los datos de la casa
        document.addEventListener('DOMContentLoaded', function() {
            cargarDatosCasa();
        });
    </script>
</body>
</html>