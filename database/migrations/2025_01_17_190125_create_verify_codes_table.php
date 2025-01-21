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
        Schema::create('verify_codes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('verify_code');
            $table->enum('used',[0,1])->default(0);
            $table->enum('why',['login','register', 'Reset Password', 'Forgot Password'])->default('register');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_codes');
    }
};
