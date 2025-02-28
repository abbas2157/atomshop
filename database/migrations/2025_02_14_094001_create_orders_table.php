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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('cart_id');
            $table->integer('total_deal_price')->default(0);
            $table->integer('advance_price')->default(0);
            $table->enum('portal',['Web', 'App'])->default('Web');
            $table->enum('status',['Pending', 'Varification', 'Processing', 'Delivered', 'Instalments', 'Completed'])->default('Pending');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
