<?php
include('../Plantilla.php');
Plantilla::aplicar();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to bottom, #fce4ec, #f8bbd0);
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
        background: rgba(255, 255, 255, 0.95);
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
        background-color: rgb(160, 130, 46);
    }

    .alert {
        font-size: 1.2rem;
        border-radius: 12px;
    }
    .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white;

    .card-universidad {
        border: none;
        border-radius: 15px;
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .card-universidad h5 {
        background-color: #f48fb1;
        font-weight: 700;
    }

    .card-universidad a {
        text-decoration: none;
        color: #007bff;
    }

    .card-universidad a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="titulo-prediccion"> Universidades de un país 🎓</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formUniversidades" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
                <div class="mb-3">
                    <label for="pais" class="form-label">Nombre del país (en inglés):</label>
                    <input type="text" class="form-control" name="pais" id="pais" placeholder="Ej. Dominican Republic" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Buscar universidades</button>
            </form>

            <div id="resultadoUniversidades" class="mt-4"></div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>

<script>
    document.getElementById('formUniversidades').addEventListener('submit', function () {
        const pais = document.getElementById('pais').value.trim();
        const resultadoDiv = document.getElementById('resultadoUniversidades');
        resultadoDiv.innerHTML = '';

        if (pais === '') {
            resultadoDiv.innerHTML = `<div class="alert alert-warning">Por favor ingresa el nombre de un país.</div>`;
            return;
        }

        const url = `https://universities.hipolabs.com/search?country=${encodeURIComponent(pais)}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    resultadoDiv.innerHTML = `<div class="alert alert-info">No se encontraron universidades para <strong>${pais}</strong>.</div>`;
                    return;
                }

                let html = '<h5 class="text-center mb-3">Universidades encontradas:</h5>';
                data.slice(0, 10).forEach(univ => {
                    html += `
                        <div class="card card-universidad p-3">
                            <h5><i class="bi bi-building"></i> ${univ.name}</h5>
                            <p><i class="bi bi-globe2"></i> <strong>Dominio:</strong> ${univ.domains[0]}</p>
                            <p><i class="bi bi-link-45deg"></i> <a href="${univ.web_pages[0]}" target="_blank">Sitio web</a></p>
                        </div>
                    `;
                });

                resultadoDiv.innerHTML = html;
            })
            .catch(error => {
                resultadoDiv.innerHTML = `<div class="alert alert-danger">Error al consultar la API.</div>`;
                console.error('Error:', error);
            });
    });
</script>
