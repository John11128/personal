<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reportes', function (Blueprint $table) {
            $table->bigIncrements('id_r');
            $table->string('tipo_r'); // 'categoria', 'producto', 'movimiento'
            $table->string('titulo_r');
            $table->text('descripcion_r')->nullable();
            $table->json('detalle_r')->nullable(); // datos del evento (nombre, cantidad, etc.)
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamp('fecha_r')->default(now());
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reportes');
    }
};
