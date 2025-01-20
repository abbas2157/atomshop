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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('pr_number')->nullable();
            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->string('picture')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->enum('status',['Published', 'Pending', 'Out of Stock', 'On hold', 'Closed'])->default('Pending');
            $table->timestamps();
        });

        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->id();
            $table->text('short', 500);
            $table->text('long');
            $table->integer('product_id')->nullable();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255);
            $table->integer('product_id')->nullable();
            $table->enum('type',['Feature', 'Gallery'])->default('Gallery');
        });

        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->integer('color_id')->nullable();
            $table->integer('product_id')->nullable();
        });

        Schema::create('product_memories', function (Blueprint $table) {
            $table->id();
            $table->integer('memory_id')->nullable();
            $table->integer('product_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_descriptions');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_memories');
    }
};
