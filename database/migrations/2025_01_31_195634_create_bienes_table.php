<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->id(); // Esto crea BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('cantidad');
            $table->string('ubicacion');
            $table->string('imagen')->nullable(); // Agregado desde la segunda migración
            $table->integer('prestados')->nullable(); // Agregado desde la segunda migración
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bienes');
    }
};
