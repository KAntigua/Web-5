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
  .pais-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 30px;
    margin-top: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
  }
  .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white;
  .bandera {
    width: 150px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  }
</style>

<div class="container mt-4 mb-5">
  <h2 class="text-center mb-4">🌍 Datos de un País</h2>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formPais" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
        <div class="mb-3">
          <label for="nombrePais" class="form-label">Nombre del país:</label>
          <input type="text" class="form-control" id="nombrePais" placeholder="Ej: Dominican Republic" required>
        </div>
        <button class="btn btn-primary w-100">Buscar País</button>
      </form>

      <div id="resultadoPais" class="mt-4"></div>
    </div>
  </div>

  <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
  </div>
</div>

<script>
  document.querySelector('#formPais button').addEventListener('click', () => {
    const nombrePais = document.getElementById('nombrePais').value.trim();
    const resultado = document.getElementById('resultadoPais');
    resultado.innerHTML = '';

    if (!nombrePais) {
      resultado.innerHTML = `<div class="alert alert-warning">Por favor ingresa el nombre de un país.</div>`;
      return;
    }

    fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(nombrePais)}`)
      .then(response => {
        if (!response.ok) throw new Error('País no encontrado');
        return response.json();
      })
      .then(data => {
        
        const pais = data[0];
        const bandera = pais.flags?.png || '';
        const capital = pais.capital ? pais.capital[0] : 'No disponible';
        const poblacion = pais.population ? pais.population.toLocaleString() : 'No disponible';
      
        const monedas = pais.currencies
          ? Object.values(pais.currencies).map(c => c.name + ` (${c.symbol || ''})`).join(', ')
          : 'No disponible';

        resultado.innerHTML = `
          <div class="pais-card shadow">
            <img src="${bandera}" alt="Bandera de ${pais.name.common}" class="bandera">
            <h3>${pais.name.common}</h3>
            <p><strong>Capital:</strong> ${capital}</p>
            <p><strong>Población:</strong> ${poblacion}</p>
            <p><strong>Moneda(s):</strong> ${monedas}</p>
          </div>`;
      })
      .catch(error => {
        resultado.innerHTML = `<div class="alert alert-danger">No se encontró el país solicitado.</div>`;
        console.error(error);
      });
  });
</script>
