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

  .form-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
  }

  .form-label {
    font-weight: 600;
  }

  .btn-primary {
    background-color: rgb(255, 25, 178);
    border: none;
  }

  .btn-primary:hover {
    background-color: rgb(204, 20, 143);
  }

  .clima-card {
    border-radius: 15px;
    padding: 25px;
    color: white;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  .clima-sol {
    background: #f48fb1;
  }

  .clima-lluvia {
    background: #ba68c8;
  }

  .clima-nublado {
    background: #ce93d8;
  }

  .icono-clima {
    font-size: 3rem;
  }

  .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white;
  }

  .text-center.mt-4 a.btn-secondary:hover {
    background-color: #ba68c8;
  }
</style>

<div class="container mt-4 mb-5">
  <h2 class="titulo-prediccion">Clima en República Dominicana 🌦️</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formClima" class="card p-4 rounded-4 shadow border-0 form-card" onsubmit="return false;">
        <div class="mb-3">
          <label for="ciudadClima" class="form-label">Ciudad:</label>
          <input type="text" class="form-control" id="ciudadClima" placeholder="Ej. Santo Domingo" required>
        </div>
        <button class="btn btn-primary w-100">Consultar clima</button>
      </form>
      <div id="resultadoClima" class="mt-4"></div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
  </div>
</div>

<script>
  const coords = {
    "santo domingo": [18.4861, -69.9312],
  "santiago": [19.45, -70.7],
  "puerto plata": [19.8, -70.7],
  "la vega": [19.2167, -70.5333],
  "higüey": [18.5833, -68.3833],
  "dajabon": [19.5333, -71.6667],
  "barahona": [18.1833, -71.1333],
  "san juan": [18.25, -71.2333]
  };

  document.getElementById("formClima").addEventListener("submit", () => {
    const ciudad = document.getElementById("ciudadClima").value.trim().toLowerCase();
    const resultado = document.getElementById("resultadoClima");
    resultado.innerHTML = "";

    if (!coords[ciudad]) {
      resultado.innerHTML = `<div class="alert alert-warning">No tengo coordenadas para "<strong>${ciudad}</strong>". Usa una de: Santo Domingo, Santiago, La Vega, Puerto Plata, Higüey.</div>`;
      return;
    }
    const [lat, lon] = coords[ciudad];

    fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
      .then(r => r.json())
      .then(data => {
        const temp = data.current_weather.temperature.toFixed(1);
        const code = data.current_weather.weathercode;
        let clase = 'clima-sol', emoji = '☀️', texto = 'Despejado';

        if ([61,63,65,80,81].includes(code)) {
          clase = 'clima-lluvia'; 
          emoji = '🌧️'; 
          texto = 'Lluvia';
        } else if ([2,3,45,48,71,75,77,85,86].includes(code)) {
          clase = 'clima-nublado'; 
          emoji = '☁️'; 
          texto = 'Nublado';
        }

        resultado.innerHTML = `
          <div class="clima-card ${clase} shadow">
            <div class="icono-clima">${emoji}</div>
            <h4>${ciudad.replace(/\b\w/g, l => l.toUpperCase())}, República Dominicana</h4>
            <p class="mb-1">🌡️ <strong>${temp} °C</strong></p>
            <p>${texto}</p>
          </div>`;
      })
      .catch(err => {
        console.error(err);
        resultado.innerHTML = `<div class="alert alert-danger">Error al consultar clima.</div>`;
      });
  });
</script>
