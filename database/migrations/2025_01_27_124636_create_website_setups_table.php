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
        Schema::create('website_setups', function (Blueprint $table) {
            $table->id();
            $table->text('categories')->nullable();
            $table->text('brands')->nullable();
            $table->text('feature_products')->nullable();
            $table->text('products')->nullable();
            $table->text('sliders')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_setups');
    }
};
