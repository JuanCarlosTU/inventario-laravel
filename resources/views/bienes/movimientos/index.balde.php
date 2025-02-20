@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Movimientos de {{ $bien->nombre }}</h2>

    <form action="{{ route('movimientos.store', $bien->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Movimiento</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Regresar</a>
    </form>

    <h3 class="mt-4">Historial de Movimientos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $mov)
            <tr>
                <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ ucfirst($mov->tipo) }}</td>
                <td>{{ $mov->cantidad }}</td>
                <td>{{ $mov->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
