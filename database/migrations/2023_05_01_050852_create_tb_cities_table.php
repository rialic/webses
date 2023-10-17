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
        Schema::create('tb_cities', function (Blueprint $table) {
            $table->id('ci_id');
            $table->uuid('ci_uuid');
            $table->string('ci_name');
            $table->unsignedBigInteger('ci_macro_region_id')->nullable();
            $table->unsignedBigInteger('ci_micro_region_id')->nullable();
            $table->boolean('ci_status')->default(true);
            $table->string('ci_ibge_code');
            $table->timestamps();

            $table->unsignedBigInteger('st_id');

            $table->foreign('st_id')->references('st_id')->on('tb_states');

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
        Schema::dropIfExists('tb_cities');
    }
};
