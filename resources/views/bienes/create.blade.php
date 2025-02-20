@section('title', 'Agregar un Bien')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Bien</h1>
    <form action="{{ route('bienes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required></textarea>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" name="ubicacion" required>
        </div>

        <!-- Input de imagen -->
        <div class="mb-3">
            <label for="imagen" class="form-label">Seleccionar Imagen</label>
            <input type="file" id="imagen" class="form-control" accept="image/*">
        </div>

        <!-- Contenedor de la imagen recortada -->
        <div class="mb-3">
            <label class="form-label">Previsualización</label>
            <div>
                <img id="preview" style="max-width: 100%; display: none;">
            </div>
        </div>

        <!-- Campo oculto para almacenar la imagen recortada -->
        <input type="hidden" name="imagen" id="imagen_base64">

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<!-- Estilos y scripts de Cropper.js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let cropper;
    const imagenInput = document.getElementById("imagen");
    const preview = document.getElementById("preview");
    const imagenBase64 = document.getElementById("imagen_base64");

    imagenInput.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(preview, {
                    aspectRatio: 1, // Mantiene la imagen cuadrada 1:1
                    viewMode: 2,
                    autoCropArea: 1,
                    crop(event) {
                        const canvas = cropper.getCroppedCanvas({
                            width: 400,
                            height: 400,
                        });

                        imagenBase64.value = canvas.toDataURL("image/jpeg");
                    }
                });
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
