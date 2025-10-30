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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_p')->primary();
            $table->string('codigo_p', 50)->unique()->nullable(); // Código interno o de barras
            $table->string('nombre_p', 150);
            $table->text('descripcion_p')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->integer('stock_p')->default(0);
            $table->decimal('precio_compra_p', 10, 2)->default(0);
            $table->decimal('precio_venta_p', 10, 2)->default(0);
            $table->string('imagen_p')->nullable();
            $table->boolean('activo_p')->default(true);
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // quién lo registró
            $table->timestamps();

            // Clave foránea de categoría (si existe tabla categorias)
            $table->foreign('categoria_id')->references('id_c')->on('categorias')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
