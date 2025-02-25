<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
    <!-- Estilos personalizados -->
    <style>
        /* Resetear márgenes y padding */
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Evitar desbordamiento horizontal */
        }

        /* Eliminar márgenes y padding del header y footer */
        .header, .footer {
            margin: 0;
            padding: 0;
            width: 100%; /* Usar 100% en lugar de 100vw */
            box-sizing: border-box; /* Incluir padding y border en el cálculo del ancho */
        }

        /* Asegurar que el contenedor interno no genere desbordamiento */
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .header {
            background: linear-gradient(135deg, #007bff, #17a2b8);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .header p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-light {
            color: white;
            border-color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #007bff;
        }

        .demo-section {
            background-color: #e9ecef;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
            text-align: center;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        .footer a {
            color: #17a2b8;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>

    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <h1>Gestión de Proyectos e Instituciones Educativas</h1>
            <p>Soluciones informáticas innovadoras para optimizar tus procesos</p>
            <p>
                <?php if($user && $user->isLoggedIn()){ ?>
                    <a class="btn btn-primary btn-lg me-2" href="php/inicio.php" role="button">
                        <i class="fas fa-user"></i> Acceder al sistema
                    </a>
                <?php } else { ?>
                    <a class="btn btn-outline-light btn-lg me-2" href="users/login.php" role="button">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                    <a class="btn btn-outline-light btn-lg" href="users/join.php" role="button">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                <?php } ?>
            </p>
        </div>
    </header>

    <!-- Contenido principal -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="fas fa-project-diagram fa-3x mb-3 text-primary"></i>
                        <h4>Gestión de Proyectos</h4>
                        <p>Herramientas avanzadas para planificar, ejecutar y monitorear tus proyectos.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="fas fa-school fa-3x mb-3 text-primary"></i>
                        <h4>Instituciones Educativas</h4>
                        <p>Soluciones diseñadas para mejorar la administración académica.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="fas fa-chart-line fa-3x mb-3 text-primary"></i>
                        <h4>Optimización de Procesos</h4>
                        <p>Haz crecer tu organización con análisis de datos precisos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Demo -->
    <section class="py-5">
        <div class="container">
            <div class="demo-section">
                <h3>Prueba nuestra demo gratuita</h3>
                <p>Puedes explorar las funcionalidades de nuestro sistema accediendo con las siguientes credenciales:</p>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Usuario
                                <strong>demo</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Contraseña
                                <strong>demodemo</strong>
                            </li>
                        </ul>
                        <p class="mt-3">
                            <a href="users/login.php" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Acceder a la demo
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $settings->site_name; ?> - Todos los derechos reservados.</p>
            <p>
                <a href="https://userspice.com/getting-started/">Política de privacidad</a> |
                <a href="https://userspice.com/getting-started/">Términos y condiciones</a>
            </p>
        </div>
    </footer>