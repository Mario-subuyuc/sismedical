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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('dpi', 20)->unique();
            $table->string('numero_seguro', 10)->unique();
            $table->string('fecha_nacimiento', 100);
            $table->string('genero', 20);
            $table->string('celular', 20);
            $table->string('correo', 100)->unique();
            $table->string('direccion', 100);
            $table->string('grupo_sanguineo', 10);
            $table->string('alergias', 255)->nullable();
            $table->string('contacto_emergencia', 100);
            $table->text('observaciones')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};

