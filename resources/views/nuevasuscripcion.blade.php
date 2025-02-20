@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success">
        <h4>¡Suscripción Exitosa!</h4>
        <p>Tu suscripción ha sido registrada correctamente. Disfruta de tu acceso premium.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Ir al Inicio</a>
    </div>
</div>
@endsection
