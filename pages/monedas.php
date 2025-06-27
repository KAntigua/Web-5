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

  .moneda-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 30px;
    font-size: 1.2rem;
  }

  .moneda-flag {
    font-size: 2rem;
    margin-right: 10px;
  }

    .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white; }
</style>

<div class="container mt-4 mb-5">
  <h2 class="text-center mb-4">💰 Conversión de Monedas</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formMoneda" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
        <div class="mb-3">
          <label for="usd" class="form-label">Cantidad en USD ($):</label>
          <input type="number" id="usd" step="0.01" min="0" class="form-control" required placeholder="Ej: 10.00">
        </div>
        <button class="btn btn-primary w-100">Convertir</button>
      </form>

      <div id="resultadoMoneda" class="mt-4"></div>
    </div>
  </div>

  <div class="text-center mt-4">
    <a href='../index.php' class='btn btn-secondary'>Volver al Inicio</a>
  </div>
</div>

<script>
  document.getElementById('formMoneda').addEventListener('submit', () => {
    const cantidadUSD = parseFloat(document.getElementById('usd').value.trim());
    const resultado = document.getElementById('resultadoMoneda');
    resultado.innerHTML = "";

    if (isNaN(cantidadUSD) || cantidadUSD <= 0) {
      resultado.innerHTML = `<div class="alert alert-warning">Por favor ingresa una cantidad válida.</div>`;
      return;
    }

    fetch('https://api.exchangerate-api.com/v4/latest/USD')
      .then(response => response.json())
      .then(data => {
        const dop = (cantidadUSD * data.rates.DOP).toFixed(2);
        const eur = (cantidadUSD * data.rates.EUR).toFixed(2);
        const mxn = (cantidadUSD * data.rates.MXN).toFixed(2);

        resultado.innerHTML = `
          <div class="moneda-card mt-4">
            <h4>USD <strong>$${cantidadUSD}</strong> equivale a:</h4>
            <p><span class="moneda-flag">🇩🇴</span> <strong>DOP $${dop}</strong></p>
            <p><span class="moneda-flag">🇪🇺</span> <strong>EUR $${eur}</strong></p>
            <p><span class="moneda-flag">🇲🇽</span> <strong>MXN $${mxn}</strong></p>
          </div>`;
      })
      .catch(error => {
        console.error(error);
        resultado.innerHTML = `<div class="alert alert-danger">Error al conectar con la API de conversión.</div>`;
      });
  });
</script>
