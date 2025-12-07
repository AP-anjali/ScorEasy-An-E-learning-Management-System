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
        Schema::create('students_info', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->default('0');
            $table->string('name');
            $table->string('email');
            $table->string('phone_no');
            $table->string('date_of_birth');
            $table->timestamp('registration_date')->useCurrent();
            $table->string('username');
            $table->string('password');
            $table->string('confirm_password');
            $table->string('profile_pic')->default('img/default_profile_pic.png');
            $table->timestamp('password_created_at')->useCurrent();

            $table->string('is_subscribed')->default('0');
            
            $table->string('is_active')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_info');
    }
};
