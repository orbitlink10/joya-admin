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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('amount_paid', 10, 2)->default(0)->after('total');
            $table->string('payment_method')->nullable()->after('amount_paid');
            $table->date('payment_date')->nullable()->after('payment_method');
            $table->text('payment_instructions')->nullable()->after('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'amount_paid',
                'payment_method',
                'payment_date',
                'payment_instructions',
            ]);
        });
    }
};
