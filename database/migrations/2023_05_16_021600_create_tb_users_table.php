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
        Schema::create('tb_users', function (Blueprint $table) {
            $table->id('us_id');
            $table->uuid('us_uuid');
            $table->string('us_name');
            $table->string('us_cpf', 14);
            $table->enum('us_sexo', ['Masculino', 'Feminino']);
            $table->string('us_cns')->nullable();
            $table->string('us_email')->unique();
            $table->enum('us_type_professional', ['01 Profissional de saúde', '02 PROVAB', '03 Mais médicos', '04 Outros'])->default('01 Profissional de saúde');
            $table->timestamp('us_verified_at')->nullable();
            $table->string('us_current_subdomain');
            $table->string('us_password');
            $table->boolean('us_status')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('tb_users');
    }
};
