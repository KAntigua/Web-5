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
  .chiste-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 30px;
    margin-top: 40px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
  }
  .titulo-chiste {
    font-weight: 700;
    color: rgb(255, 25, 178);
    text-shadow: 1px 1px 5px rgba(200,20,140,0.8);
  }
  .btn-refresh {
    background-color: rgb(255, 25, 178);
    border: none;
    color: white;
    margin-top: 20px;
    padding: 10px 25px;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
  }
  .btn-refresh:hover {
    background-color: rgb(200, 20, 140);
  }
</style>

<div class="container">
  <h2 class="text-center mt-5 titulo-chiste">🤣 Generador de Chistes</h2>
  <div id="chiste" class="chiste-card">
    <h4 id="setup">Cargando chiste...</h4>
    <p id="punchline" style="font-style: italic; margin-top: 15px;"></p>
    <button class="btn-refresh" onclick="cargarChiste()">Otro chiste</button>
  </div>

  <div class="text-center mt-5">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
  </div>
</div>

<script>
  async function cargarChiste() {
    const setupEl = document.getElementById('setup');
    const punchlineEl = document.getElementById('punchline');
    setupEl.textContent = 'Cargando chiste...';
    punchlineEl.textContent = '';

    try {
      const response = await fetch('https://official-joke-api.appspot.com/random_joke');
      if (!response.ok) throw new Error('Error al obtener el chiste');
      const data = await response.json();

      setupEl.textContent = data.setup;
      punchlineEl.textContent = data.punchline;
    } catch (error) {
      setupEl.textContent = '¡Ups! No se pudo cargar el chiste.';
      punchlineEl.textContent = '';
      console.error(error);
    }
  }

  // Cargar un chiste al cargar la página
  cargarChiste();
</script>
