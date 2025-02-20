<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\MovimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalSubscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bienes', BienController::class);

Route::get('/bienes/{bien}/edit', [BienController::class, 'edit'])->name('bienes.edit');
Route::put('/bienes/{bien}', [BienController::class, 'update'])->name('bienes.update');
Route::delete('/bienes/{bien}', [BienController::class, 'destroy'])->name('bienes.destroy');
Route::get('/bienes/{id}/movimiento', [BienController::class, 'movimiento'])->name('bienes.movimiento');

Route::resource('movimientos', BienController::class);

Route::get('/bienes/{bien}/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
Route::post('/bienes/{bien}/movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');


Route::get('/paypal/plan/create', [PayPalSubscriptionController::class, 'createPlan'])->name('paypal.plan.create');
Route::get('/paypal/subscribe/{plan_id}', [PayPalSubscriptionController::class, 'subscribeToPlan'])->name('paypal.subscribe');
Route::get('/paypal/subscription/success', [PayPalSubscriptionController::class, 'successSubscription'])->name('paypal.subscription.success');
Route::get('/paypal/subscription/cancel', [PayPalSubscriptionController::class, 'cancelSubscription'])->name('paypal.subscription.cancel');

Route::middleware(['auth'])->group(function () {
    Route::get('/paypal/success-subscription', [PayPalSubscriptionController::class, 'successSubscription'])
        ->name('paypal.success.subscription');

    Route::get('/nuevasuscripcion', function () {
        return view('nuevasuscripcion');
    })->name('nuevasuscripcion');
});

require __DIR__.'/auth.php';
