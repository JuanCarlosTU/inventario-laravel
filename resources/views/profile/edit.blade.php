@section('title', 'Panel de Control - Mi Perfil')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-primary leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 space-y-6">
                    <div class="card p-4 shadow rounded">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card p-4 shadow rounded">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card p-4 shadow rounded">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>