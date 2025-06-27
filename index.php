<?php
include('Plantilla.php');
Plantilla::aplicar();
?>
<style>
.titulo-prediccion {
        font-family: 'Poppins', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        color: rgb(17, 50, 71);
        margin-bottom: 40px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        letter-spacing: 1px;
    }
    .neon-text-rosa {
    font-family: 'Poppins', sans-serif;
    font-size: 2rem;
    color: #fff;
    text-shadow:
        0 0 5px #ff69b4,
        0 0 10px #ff69b4,
        0 0 20px #ff1493,
        0 0 40px #ff1493,
        0 0 80px #ff1493;
    animation: brillo-rosa 1.5s ease-in-out infinite alternate;
}

@keyframes brillo-rosa {
    from {
        text-shadow:
            0 0 5px #ff69b4,
            0 0 10px #ff69b4,
            0 0 20px #ff1493,
            0 0 40px #ff1493,
            0 0 80px #ff1493;
    }
    to {
        text-shadow:
            0 0 10px #ff91e4,
            0 0 20px #ff91e4,
            0 0 30px #ff69b4,
            0 0 50px #ff69b4,
            0 0 100px #ff69b4;
    }
}

    </style>
<div class="container mt-5 text-center">
<h2 class="titulo-prediccion">Pagina principal</h2>
    <img src="assets/img/fotopasaporte.jpg" class="rounded-circle mt-4" width="150" alt="Foto de Karen">
    <h3 class="mt-3 neon-text-rosa">Karen Margarita Antigua Fabian</h3>


</div>
<?php

?>
