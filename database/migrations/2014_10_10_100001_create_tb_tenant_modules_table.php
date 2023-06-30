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
        Schema::create('tb_tenant_modules', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('mo_id');
            $table->boolean('tm_status')->default(true);
            $table->timestamps();

            $table->foreign('tenant_id')->references('tenant_id')->on('tb_tenants')->onDelete('cascade');
            $table->foreign('mo_id')->references('mo_id')->on('tb_modules')->onDelete('cascade');

            $table->primary(['tenant_id','mo_id']);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

        });

        Schema::table('tb_tenant_modules', function(Blueprint $table) {
            DB::statement("ALTER TABLE tb_tenant_modules ADD tm_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD INDEX (tm_id)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tenant_modules');
    }
};
