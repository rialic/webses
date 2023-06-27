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
        Schema::create('tb_cbo', function (Blueprint $table) {
            $table->id('cbo_id');
            $table->uuid('cbo_uuid');
            $table->string('cbo_name', 150);
            $table->string('cbo_code', 15);
            $table->boolean('cbo_status')->default(true);
            $table->timestamps();

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
        Schema::dropIfExists('tb_cbo');
    }
};
