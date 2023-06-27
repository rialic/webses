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
        Schema::create('tb_establishments', function (Blueprint $table) {
            $table->id('es_id');
            $table->uuid('es_uuid');
            $table->string('es_name', 250);
            $table->string('es_cnes', 15);
            $table->enum('es_management', ['DUPLA', 'ESTADUAL', 'MUNICIPAL']);
            $table->enum('es_legal_nature', ['ADMINISTRAÇÃO PÚBLICA', 'ENTIDADES EMPRESARIAIS', 'ENTIDADES SEM FINS LUCRATIVOS', 'ORGANIZAÇÕES INTERNACIONAIS/OUTRAS']);
            $table->enum('es_sus', ['Sim', 'Não']);
            $table->boolean('es_status')->default(true);
            $table->string('es_datacnes_id');
            $table->timestamps();

            $table->unsignedBigInteger('ci_id');

            $table->foreign('ci_id')->references('ci_id')->on('tb_cities');

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
        Schema::dropIfExists('tb_establishments');
    }
};
