@section('title', 'Movimientos')
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Movimientos de {{ $bien->nombre }}</h2>

    <form action="{{ route('movimientos.store', $bien->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Movimiento</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="Entrada">Entrada</option>
                <option value="Salida">Salida</option>
                <option value="Devolución">Devolución</option>
                <option value="Préstamo">Préstamo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="mb-3">
            <label for="persona" class="form-label">persona</label>
            <input type="text" class="form-control" id="persona" name="persona" required>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
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
                <th>Persona</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movimientos as $mov)
                <tr>
                    <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ ucfirst($mov->tipo) }}</td>
                    <td>{{ $mov->cantidad }}</td>
                    <td>{{ $mov->persona }}</td>
                    <td>{{ $mov->observaciones }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
