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
        // TODO APAGAR ESSA MIGRATION POIS JÁ FOI INSERIDO NA TABELA PRINCIPAL DE USERS
        Schema::table('tb_users', function (Blueprint $table) {
            $table->string('us_current_subdomain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_users', function (Blueprint $table) {
            $table->dropColumn(['us_current_subdomain']);
        });
    }
};
