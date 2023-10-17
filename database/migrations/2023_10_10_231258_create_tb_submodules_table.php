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
        Schema::create('tb_submodules', function (Blueprint $table) {
            $table->id('sub_id');
            $table->uuid('sub_uuid');
            $table->string('sub_name', 150);
            $table->boolean('sub_status')->default(true);
            $table->timestamps();

            $table->unsignedBigInteger('mo_id');

            $table->foreign('mo_id')->references('mo_id')->on('tb_modules')->onDelete('cascade');

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
        Schema::dropIfExists('tb_submodules');
    }
};
