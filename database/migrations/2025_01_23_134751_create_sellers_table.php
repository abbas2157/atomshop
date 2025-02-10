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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('cnic_number')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('city_id')->nullable()->index();
            $table->foreignId('area_id')->nullable()->index();
            $table->string('address', 255)->nullable();
            $table->string('investment_capacity')->nullable();
            $table->enum('previous_experience',[0,1])->default(0);
            $table->enum('verified',[0,1])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
