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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('picture')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->string('address', 255)->nullable();
            $table->foreignId('city_id')->nullable()->index();
            $table->foreignId('area_id')->nullable()->index();
            $table->enum('verified',[0,1])->default(0);
            $table->text('not_verified_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
