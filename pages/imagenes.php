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
  .form-label {
    font-weight: 600;
  }
  .btn-primary {
    background-color: rgb(255, 25, 178);
    border: none;
  }
  .btn-primary:hover {
    background-color: rgb(200, 20, 140);
  }
  .image-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 25px;
    text-align: center;
    margin-top: 20px;
  }
  .image-card img {
    max-width: 100%;
    border-radius: 15px;
    margin-top: 15px;
  }

    .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white; }
</style>

<div class="container mt-4 mb-5">
  <h2 class="text-center mb-4">🖼️ Busca una Imagen</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formImagen" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
        <div class="mb-3">
          <label for="keyword" class="form-label">Palabra clave:</label>
          <input type="text" id="keyword" class="form-control" placeholder="Ej: gato, playa, naturaleza" required>
        </div>
        <button class="btn btn-primary w-100">Buscar imagen</button>
      </form>

      <div id="resultadoImagen" class="image-card" style="display:none;">
        <h4>Imagen para: <span id="textoClave"></span></h4>
        <img id="imagenResultado" src="" alt="Imagen buscada">
      </div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
  </div>
</div>

<script>
  document.getElementById('formImagen').addEventListener('submit', () => {
    const keyword = document.getElementById('keyword').value.trim();
    if (!keyword) return;

    const url = `https://loremflickr.com/600/400/${encodeURIComponent(keyword)}`;
    document.getElementById('imagenResultado').src = url + '?random=' + new Date().getTime(); 
    document.getElementById('textoClave').textContent = keyword;
    document.getElementById('resultadoImagen').style.display = 'block';
  });
</script>
