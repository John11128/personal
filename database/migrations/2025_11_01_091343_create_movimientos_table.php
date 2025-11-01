<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
           $table->bigIncrements('id_m');
            $table->dateTime('fecha_m');
            $table->enum('tipo_m', ['entrada', 'salida']);
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad_m');
            $table->string('usuario_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
