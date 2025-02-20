@section('title', 'Editar un Bien')
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Bien</h2>

    <form action="{{ route('bienes.update', $bien->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $bien->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ $bien->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicacion</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value='{{ $bien->ubicacion }}'>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $bien->cantidad }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            <small class="text-muted">Seleccione una nueva imagen solo si desea cambiarla.</small>
        
       
        </div>
             <!-- Contenedor de la imagen recortada -->
             <div class="mb-3">
                <p class="form-label">{{ 'Previsualizacion' }}</p>
                <div>
                    <img id="preview" style="max-width: 100%; display: none;">
                </div>
            </div>
    
            <!-- Campo oculto para almacenar la imagen recortada -->
            <input type="hidden" name="imagen_base64" id="imagen_base64">
        

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<x-cropper />

@endsection
