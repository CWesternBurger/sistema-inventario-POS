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
            $table->id();
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->string('codigo', 50)->unique()->comment('Código de barras o SKU');
            $table->decimal("precio_compra", 8, 2);
            $table->decimal("precio_venta", 8, 2);
            $table->integer('cantidad')->comment('Stock disponible');
            $table->string('imagen_ruta')->nullable();

            // Claves foráneas (¡ahora se ejecutarán después de las tablas que referencian!)
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->onDelete('set null');

            $table->timestamps();
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
