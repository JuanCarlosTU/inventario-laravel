<section class="mt-3">
    <header>
        <h2 class="fs-4 fw-medium">
            {{ __('Eliminar Cuenta') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Cuando tu cuenta se elimine, todos los recursos y datos seran permanentemente eliminados. Antes de Eliminarla, Por favor descarga toda informacion o datos que necesitas mantener.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        {{ __('Eliminar Cuenta') }}
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirm-user-deletionLabel">{{ __('¿Estas Seguro que realmente quieres eliminar tu cuenta?') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mt-1 text-sm">
                        {{ __('Cuando tu cuenta se elimine, todos los recursos y datos seran permanentemente eliminados. Por favor ingresar password para eliminar defnitivamente tu cuenta.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label sr-only">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>