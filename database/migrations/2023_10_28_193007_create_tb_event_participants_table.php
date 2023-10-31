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
        Schema::create('tb_event_participants', function (Blueprint $table) {
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('ev_id');
            $table->unsignedBigInteger('tenant_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('us_id')->references('us_id')->on('tb_users')->onDelete('cascade');
            $table->foreign('ev_id')->references('ev_id')->on('tb_events')->onDelete('cascade');
            $table->foreign('tenant_id')->references('tenant_id')->on('tb_tenants')->onDelete('cascade');

            $table->primary(['us_id', 'ev_id']);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::table('tb_event_participants', function(Blueprint $table) {
            DB::statement("ALTER TABLE tb_event_participants ADD ep_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD INDEX (ep_id)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_event_participants');
    }
};
