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
        Schema::create('tb_events', function (Blueprint $table) {
            $table->id('ev_id');
            $table->uuid('ev_uuid');
            $table->string('ev_name', 200);
            $table->text('ev_description');
            $table->boolean('ev_status')->default(true);
            $table->string('ev_bireme_code', 100)->nullable();
            $table->timestamp('ev_start_at');
            $table->integer('ev_start_minutes_additions')->default(15);
            $table->timestamp('ev_end_at');
            $table->integer('ev_end_minutes_additions')->default(15);
            $table->string('ev_virtual_room', 15);
            $table->string('ev_room_link', 500);
            $table->timestamps();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('tenant_id');

            $table->foreign('created_by')->references('us_id')->on('tb_users');
            $table->foreign('tenant_id')->references('tenant_id')->on('tb_tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_events');
    }
};
