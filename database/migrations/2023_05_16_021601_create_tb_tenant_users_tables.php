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
        Schema::create('tb_tenant_users', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('us_id');
            $table->boolean('tu_status')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('tenant_id')->references('tenant_id')->on('tb_tenants')->onDelete('cascade');
            $table->foreign('us_id')->references('us_id')->on('tb_users');

            $table->primary(['tenant_id', 'us_id']);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::table('tb_tenant_users', function(Blueprint $table) {
            DB::statement("ALTER TABLE tb_tenant_users ADD tu_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD INDEX (tu_id)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tenant_users');
    }
};
