<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
<style>
  body {
    background: linear-gradient(to bottom, #fce4ec, #f8bbd0);
    font-family: 'Poppins', sans-serif;
  }

  .titulo-prediccion {
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

  .btn-warning {
    background-color: rgb(255, 25, 178);
    border: none;
    color:rgb(255, 255, 255);
  }

  .btn-warning:hover {
    background-color: rgb(255, 25, 178);
  }

  .card-pokemon {
    border-radius: 15px;
    padding: 25px;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    color: rgb(17, 50, 71);
  }

  .pokemon-img {
    width: 150px;
    height: 150px;
    image-rendering: pixelated;
    margin-bottom: 1rem;
  }

  audio {
    margin-top: 15px;
    outline: none;
  }

  .alert {
    font-size: 1.2rem;
    border-radius: 12px;
  }

  .text-center.mt-4 a.btn-secondary {
    background-color:rgb(112, 60, 77);
    border: none;
    color: white;
  }

  .text-center.mt-4 a.btn-secondary:hover {
    background-color: #ba68c8;
  }
</style>

<div class="container mt-4 mb-5">
  <h2 class="titulo-prediccion">Información de Pokémon ⚡</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formPokemon" class="card p-4 rounded-4 shadow border-0 form-card" onsubmit="return false;">
        <div class="mb-3">
          <label for="inputPokemon" class="form-label">Nombre del Pokémon:</label>
          <input type="text" id="inputPokemon" class="form-control" placeholder="Ej: pikachu" required />
        </div>
        <button class="btn btn-warning w-100" type="submit">Buscar Pokémon</button>
      </form>

      <div id="resultadoPokemon" class="mt-4"></div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
  </div>
</div>

<script>
  document.getElementById('formPokemon').addEventListener('submit', () => {
    const nombre = document.getElementById('inputPokemon').value.trim().toLowerCase();
    const resultadoDiv = document.getElementById('resultadoPokemon');
    resultadoDiv.innerHTML = '';

    if (!nombre) {
      resultadoDiv.innerHTML = `<div class="alert alert-warning">Por favor ingresa un nombre de Pokémon.</div>`;
      return;
    }

    fetch(`https://pokeapi.co/api/v2/pokemon/${encodeURIComponent(nombre)}`)
      .then(response => {
        if (!response.ok) throw new Error('Pokémon no encontrado');
        return response.json();
      })
      .then(data => {
        const name = data.name.charAt(0).toUpperCase() + data.name.slice(1);
        const img = data.sprites.front_default;
        const exp = data.base_experience;
        const abilities = data.abilities.map(a => a.ability.name).join(', ');
        const sound = `https://play.pokemonshowdown.com/audio/cries/${nombre}.mp3`;

        resultadoDiv.innerHTML = `
          <div class="card-pokemon">
            <h4>${name}</h4>
            <img src="${img}" alt="Imagen de ${name}" class="pokemon-img" />
            <p>Experiencia base: <strong>${exp}</strong></p>
            <p>Habilidades: <strong>${abilities}</strong></p>
            <audio controls>
              <source src="${sound}" type="audio/mpeg" />
              Tu navegador no soporta audio.
            </audio>
          </div>
        `;
      })
      .catch(() => {
        resultadoDiv.innerHTML = `<div class="alert alert-danger">No se encontró ese Pokémon.</div>`;
      });
  });
</script>
