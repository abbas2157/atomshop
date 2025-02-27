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
        Schema::create('customer_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('customer_id')->nullable()->index();
            $table->string('id_card_front_side')->nullable();
            $table->string('id_card_back_side')->nullable();
            $table->enum('address_found',[0,1])->default(0);
            $table->enum('house',['rent','self'])->nullable();
            $table->enum('customer_physical_meet',[0,1])->default(0);
            $table->enum('work',['job','bussiness'])->nullable();
            $table->string('selfie_with_customer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_verifications');
    }
};
