@section('title', 'Mi Inventario')
@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <h1>Inventario</h1>
    <a href="{{ route('bienes.create') }}" class="btn btn-success mb-3">Crear Bien</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bienes as $bien)
                <tr>
                    <td>
                        @if($bien->imagen)
                            <img src="{{ asset('storage/' . $bien->imagen) }}" alt="Imagen de {{ $bien->nombre }}" class="img-thumbnail" width="100">
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>{{ $bien->nombre }}</td>
                    <td>{{ $bien->descripcion }}</td>
                    <td>{{ $bien->cantidad }}</td>
                    <td>{{ $bien->ubicacion }}</td>
                    <td>
                        <a href="{{ route('bienes.edit', $bien->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('bienes.destroy', $bien->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este bien?')">Eliminar</button>
                        </form>
                        <a href="{{ route(('movimientos.index'), $bien->id) }}" class="btn btn-primary btn-sm">Movimientos</a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
