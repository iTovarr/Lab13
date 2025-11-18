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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea para conectar con la tabla 'notas'
            $table->foreignId('nota_id')
                  ->constrained('notas') // Asegura que exista en la tabla 'notas'
                  ->onDelete('cascade'); // <-- ¡Esto es clave para la Parte C!

            $table->string('descripcion');
            $table->boolean('completada')->default(false);
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
