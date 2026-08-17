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
        Schema::create('page_optimization_results', function (Blueprint $table) {
            $table->id();
            $table->string('page_url');
            $table->string('competitor_url')->nullable();
            $table->string('target_keyword')->nullable();
            $table->unsignedTinyInteger('seo_score')->default(0);
            $table->unsignedInteger('gaps_count')->default(0);
            $table->unsignedInteger('high_priority_count')->default(0);
            $table->unsignedInteger('word_count')->default(0);
            $table->unsignedInteger('competitor_word_count')->nullable();
            $table->unsignedInteger('fetch_ms')->nullable();
            $table->json('page_signals')->nullable();
            $table->json('competitor_signals')->nullable();
            $table->json('gaps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_optimization_results');
    }
};
