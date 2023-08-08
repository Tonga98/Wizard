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
        Schema::enableForeignKeyConstraints();
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('apellido', 255);
            $table->string('ubicacion', 255)->nullable();
            $table->bigInteger('num_telefono')->nullable()->unique();
            $table->timestamps();

            //Foreing keys
            $table->foreignId('camioneta_id')->constrained(table: 'camionetas', indexName: 'fk_pasajero_camioneta_id');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajeros');
    }
};
