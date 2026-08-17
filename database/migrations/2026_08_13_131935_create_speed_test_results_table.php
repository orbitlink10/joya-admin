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
        Schema::create('speed_test_results', function (Blueprint $table) {
            $table->id();
            $table->decimal('ping_ms', 8, 2)->nullable();
            $table->decimal('download_mbps', 8, 2)->nullable();
            $table->decimal('upload_mbps', 8, 2)->nullable();
            $table->string('test_mode')->default('standard');
            $table->string('server_name')->nullable();
            $table->string('ip_hash')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speed_test_results');
    }
};
