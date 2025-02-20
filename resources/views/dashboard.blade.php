@section('title', 'Panel de Control - Mis Aplicaciónes')
<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-primary fs-1 text-center">
                    {{ __("Bienvenido") }}<br/>
                    <img src="storage/img/LOGO.svg" style="max-width: 15%" alt="MI" />
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-dark">
                    {{ __("¿Quieres ir a tu inventario de bienes?") }}
                    <a href="{{ route('bienes.index') }}"<input type="button" class="btn btn-primary">
                        {{ __('Inventario') }}
                    </a>
                </input>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('paypal.subscribe', 'P-9SE17690D32086220M6ZZ3NY') }}">
        <button class=" btn btn-success fw-b">Suscribirme por $10/mes</button>
    </a>
</x-app-layout>
