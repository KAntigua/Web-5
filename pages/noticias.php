<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to bottom, #fce4ec, #f8bbd0);
        font-family: 'Poppins', sans-serif;
    }

    .btn-secondary {
      background-color: rgb(255, 25, 178);
        border: none;
    }

    .btn-secondary:hover {
      background-color: rgb(255, 25, 178);
    }

    .card-title {
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .noticia-logo {
        width: 48px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
</style>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">📰 Últimas Noticias desde WordPress</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="GET" class="card p-4 rounded-4 shadow border-0">
                <div class="mb-3">
                    <label for="site" class="form-label">Sitio WordPress:</label>
                    <input type="text" name="site" id="site" class="form-control" placeholder="Ej: https://techcrunch.com" required>
                </div>
                <button type="submit" class="btn btn-secondary w-100">Cargar Noticias</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_GET['site'])) {
        $site = rtrim(trim($_GET['site']), '/');
        $url = $site . "/wp-json/wp/v2/posts?_embed&per_page=3";

        $response = @file_get_contents($url);

        if ($response !== false) {
            $posts = json_decode($response, true);

            if (!empty($posts)) {
                echo "<div class='row mt-4'>";
                foreach ($posts as $post) {
                    $title = $post['title']['rendered'];
                    $excerpt = strip_tags($post['excerpt']['rendered']);
                    $link = $post['link'];
                    $logo = $post['_embedded']['author'][0]['avatar_urls']['48'];

                    echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card h-100 shadow-sm'>
                            <div class='card-body'>
                                <img src='$logo' alt='logo' class='noticia-logo'>
                                <h5 class='card-title'>$title</h5>
                                <p class='card-text'>$excerpt</p>
                                <a href='$link' target='_blank' class='btn btn-outline-dark'>Leer más</a>
                            </div>
                        </div>
                    </div>";
                }
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning text-center mt-4'>No se encontraron noticias.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center mt-4'>No se pudo conectar a la API del sitio ingresado. Asegúrate de que usa WordPress.</div>";
        }
    }
    ?>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>
