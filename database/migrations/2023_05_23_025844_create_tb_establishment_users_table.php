<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_establishment_users', function (Blueprint $table) {
            $table->boolean('eu_primary_bond');
            $table->boolean('eu_status')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->unsignedBigInteger('es_id');
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('cbo_id');

            $table->foreign('es_id')->references('es_id')->on('tb_establishments')->onDelete('cascade');
            $table->foreign('us_id')->references('us_id')->on('tb_users')->onDelete('cascade');
            $table->foreign('cbo_id')->references('cbo_id')->on('tb_cbo')->onDelete('cascade');

            $table->primary(['es_id', 'us_id']);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

        });

        Schema::table('tb_establishment_users', function(Blueprint $table) {
            DB::statement("ALTER TABLE tb_establishment_users ADD eu_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD INDEX (eu_id)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_establishment_users_cbo');
    }
};
