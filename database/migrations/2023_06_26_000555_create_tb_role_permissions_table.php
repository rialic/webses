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
        Schema::create('tb_role_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('ro_id');
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('tenant_id');
            $table->boolean('rp_status')->default(true);
            $table->timestamps();

            $table->foreign('ro_id')->references('ro_id')->on('tb_roles')->onDelete('cascade');
            $table->foreign('us_id')->references('us_id')->on('tb_users')->onDelete('cascade');
            $table->foreign('tenant_id')->references('tenant_id')->on('tb_tenants')->onDelete('cascade');

            $table->primary(['ro_id', 'us_id']);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::table('tb_role_permissions', function(Blueprint $table) {
            DB::statement("ALTER TABLE tb_role_permissions ADD rp_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD INDEX (rp_id)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_role_permissions');
    }
};
