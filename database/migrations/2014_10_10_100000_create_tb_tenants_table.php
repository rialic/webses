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
        Schema::create('tb_tenants', function (Blueprint $table) {
            $table->id('tenant_id');
            $table->uuid('tenant_uuid');
            $table->string('tenant_name', 150)->unique();
            $table->string('tenant_subdomain')->unique();
            $table->boolean('tenant_status')->default(true);
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
        Schema::dropIfExists('tb_tenants');
    }
};
