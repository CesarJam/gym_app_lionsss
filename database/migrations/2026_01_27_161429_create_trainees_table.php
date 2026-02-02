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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            
            // RELACIÓN: Este alumno pertenece a un Entrenador
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            
            // Datos físicos (útiles para la App Móvil luego)
            $table->date('birth_date')->nullable();
            $table->decimal('weight', 5, 2)->nullable(); // Ej: 85.50
            $table->integer('height')->nullable(); // En cm, ej: 175
            $table->text('goal')->nullable(); // Ej: "Bajar grasa", "Hipertrofia"
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
