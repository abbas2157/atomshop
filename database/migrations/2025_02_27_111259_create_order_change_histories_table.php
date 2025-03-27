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
        Schema::create('order_change_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('order_id')->nullable()->index();

            $table->text('payload')->nullable();

            $table->enum('status',['Pending', 'Varification', 'Processing', 'Delivered', 'Instalments', 'Completed', 'Cancelled'])->default('Pending');
            $table->enum('role',['seller', 'admin'])->default('seller');
            $table->enum('order_type',['Normal', 'Custom'])->default('Normal');
            $table->foreignId('changed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_change_hsitories');
    }
};
