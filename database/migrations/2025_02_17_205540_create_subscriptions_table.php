<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuario
            $table->string('paypal_subscription_id')->unique(); // ID de la suscripción en PayPal
            $table->string('status')->default('ACTIVE'); // Estado de la suscripción
            $table->date('start_date')->nullable(); // Fecha de inicio
            $table->date('next_billing_date')->nullable(); // Próximo cobro
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
