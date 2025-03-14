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
        Schema::create('custom_order_products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('pr_number')->nullable()->index();
            $table->string('title', 255);
            $table->integer('price')->nullable();
            $table->integer('advance_price')->nullable();
            $table->string('picture')->nullable();
            $table->foreignId('category_id')->nullable()->index();
            $table->foreignId('brand_id')->nullable()->index();
            $table->enum('status',['Published', 'Pending', 'Out of Stock', 'On hold', 'Closed'])->default('Pending');
            $table->foreignId('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_order_products');
    }
};
