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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('guest_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('color_id')->nullable();
            $table->integer('memory_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->enum('status',['Pending', 'Purchased'])->default('Pending');
            $table->enum('portal',['Web', 'App'])->default('Web');
            $table->timestamps();
            $table->index(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
