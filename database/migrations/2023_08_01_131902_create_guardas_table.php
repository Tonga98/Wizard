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
        Schema::create('guardas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('apellido', 255);
            $table->unsignedInteger('dni_num')->unique();
            $table->string('email',191)->nullable()->unique();
            $table->string('ubicacion', 255)->nullable();
            $table->bigInteger('num_telefono')->nullable()->unique();
            $table->string('dni_frente', 255)->nullable();
            $table->string('dni_dorso', 255)->nullable();
            $table->string('antecedentes_foto', 255)->nullable();
            $table->date('antecedentes_venc')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            //Foreing keys
            $table->foreignId('camioneta_id')->constrained(table: 'camionetas', indexName: 'fk_guarda_camioneta_id');

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
        Schema::dropIfExists('guardas');
    }
};
