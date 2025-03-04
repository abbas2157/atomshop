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
        Schema::create('order_instalments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('order_id')->nullable()->index();
            $table->string('month')->nullable();
            $table->integer('installment_price')->default(0);
            $table->string('receipet')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('type',['Advance', 'Instalment'])->default('Instalment');
            $table->enum('status',['Paind', 'Unpaid'])->default('Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_instalments');
    }
};
