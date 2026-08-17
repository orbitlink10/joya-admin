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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Joya Atelier');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('location')->nullable();
            $table->text('business_hours')->nullable();
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'site_name' => 'Joya Atelier',
            'phone' => '+254746761556',
            'email' => 'Joygachanja10@gmail.com',
            'whatsapp' => '+254746761556',
            'location' => 'Nairobi County',
            'business_hours' => 'Monday - Saturday, 8:00 AM - 6:00 PM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
