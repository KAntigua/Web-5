<?php
class Plantilla {
    public static $instancia = null;

    public static function aplicar(): Plantilla {
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    public function __construct() {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Portal de APIs - Karen Antigua</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    background: linear-gradient(to bottom, #fce4ec, #f8bbd0);
                    padding-top: 90px;
                    min-height: 100vh;
                }
                .navbar-custom {
                    background-color: #d81b60;
                    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                }
                .nav-link {
                    font-weight: 500;
                    color: #fff !important;
                    transition: background 0.3s;
                }
                .nav-link:hover {
                    background-color: rgba(255, 255, 255, 0.2);
                    border-radius: 10px;
                    padding: 6px 12px;
                }
                footer {
                    padding-top: 2rem;
                    color: #6d1b7b;
                }
            </style>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                <div class="container">
                    <a class="navbar-brand fw-bold text-white" href="/index.php">Inicio</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto gap-2">
                            <li class="nav-item"><a class="nav-link" href="/pages/genero.php">Género</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/edad.php">Edad</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/pais.php">País</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/clima.php">Clima</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/pokemon.php">Pokémon</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/noticias.php">Noticias</a></li>
                           
                            <li class="nav-item"><a class="nav-link" href="/pages/monedas.php">Monedas</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/imagenes.php">Imágenes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/universidades.php">Universidades</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/chistes.php">Chistes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pages/acerca.php">Acerca de</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
    }

    public function __destruct() {
        ?>
        <footer class="text-center mt-5 mb-4">
            <hr>
            <p>&copy; <?= date('Y') ?> Karen Antigua - Portal Web en PHP con APIs Externas</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
}
?>
