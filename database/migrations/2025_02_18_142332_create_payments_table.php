<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('paypal_subscription_id');
            $table->decimal('amount', 10, 2); // Monto del pago
            $table->string('currency', 10); // Moneda
            $table->string('status'); // Estado del pago (ej. COMPLETED)
            $table->timestamp('payment_date'); // Fecha del pago
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
