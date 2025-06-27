<?php
include('../plantilla.php');
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

.texto-cuadro {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 25px 30px;
    max-width: 700px;
    margin: 0 auto 40px auto;
    font-size: 1.2rem;
    color: rgb(40, 40, 40);
    line-height: 1.6;
}
.texto-cuadro strong {
    color: rgb(255, 25, 178);
}
</style>

<div class="container mt-5">
    <h2 class="titulo-prediccion">Acerca del Proyecto</h2>

    <div class="texto-cuadro">
        <p>Este portal fue desarrollado usando <strong>Bootstrap 5</strong> como framework CSS.</p>
        <p>Bootstrap fue elegido por su facilidad de uso, componentes preconstruidos y adaptabilidad a móviles.</p>
    </div>
</div>
