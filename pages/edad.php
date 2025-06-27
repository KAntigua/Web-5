<?php
include('../Plantilla.php');
Plantilla::aplicar();
$nombreEdad = '';
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
        background-color: rgb(160, 130, 46);
    }

    .alert {
        font-size: 1.2rem;
        border-radius: 12px;
    }

    .edad-img {
        width: 100px;
        height: auto;
        margin-top: 10px;
    }
    .text-center.mt-4 a.btn-secondary {
    background-color: #f48fb1;
    border: none;
    color: white; }
</style>

<div class="container mt-4 mb-5">
    <h2 class="titulo-prediccion">Predicción de Edad 🧓🧑👶</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formEdad" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
                <div class="mb-3">
                    <label for="nombreEdad" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombreEdad" id="nombreEdad" placeholder="Ej. Juan" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Predecir edad</button>
            </form>

            <div id="resultadoEdad" class="mt-4"></div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>

<script>
    document.getElementById('formEdad').addEventListener('submit', function () {
        const nombreEdad = document.getElementById('nombreEdad').value.trim();
        const resultadoEdadDiv = document.getElementById('resultadoEdad');
        resultadoEdadDiv.innerHTML = '';

        if (nombreEdad === '') {
            resultadoEdadDiv.innerHTML = `<div class="alert alert-warning">Por favor ingresa un nombre.</div>`;
            return;
        }

        fetch(`https://api.agify.io/?name=${encodeURIComponent(nombreEdad)}`)
            .then(response => response.json())
            .then(data => {
                if (!data.age) {
                    resultadoEdadDiv.innerHTML = `
                        <div class="alert alert-secondary text-center">
                            <i class="bi bi-question-circle"></i>
                            El nombre <strong>${nombreEdad}</strong> no tiene edad estimada disponible.
                        </div>`;
                    return;
                }

                const edad = data.age;
                let categoria = '';
                let emoji = '';
                let imagen = '';

                if (edad < 25) {
                    categoria = 'Joven';
                    emoji = '👶';
                    
                } else if (edad < 60) {
                    categoria = 'Adulto';
                    emoji = '🧑';
                    
                } else {
                    categoria = 'Anciano';
                    emoji = '👴';
                    
                }

                resultadoEdadDiv.innerHTML = `
                    <div class="alert text-white text-center" style="background-color: rgb(17, 50, 71);">
                        <i class="bi bi-hourglass-split"></i> El nombre <strong>${nombreEdad}</strong> tiene una edad estimada de <strong>${edad}</strong> años.<br>
                        Categoría: <strong>${categoria}</strong> ${emoji}<br>
                       
                    </div>`;
            })
            .catch(error => {
                resultadoEdadDiv.innerHTML = `<div class="alert alert-danger">Error al consultar la API.</div>`;
                console.error('Error:', error);
            });
    });
</script>
