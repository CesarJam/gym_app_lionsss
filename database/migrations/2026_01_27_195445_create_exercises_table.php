<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Clasificación basada en tu lista
            $table->string('muscle_group'); // Ej: Brazos
            $table->string('specific_muscle')->nullable(); // Ej: Bíceps

            // Equipamiento (Campo sugerido)
            $table->enum('equipment', ['ninguno', 'mancuernas', 'barra', 'maquina', 'polea', 'kettlebell', 'ligas'])->default('ninguno');

            // Multimedia
            $table->string('image_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
