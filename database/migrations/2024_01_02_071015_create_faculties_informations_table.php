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
        Schema::create('faculties_informations', function (Blueprint $table) {
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
            $table->timestamp('password_created_at')->useCurrent();
            $table->string('bank_name');
            $table->string('bank_branch');

            $table->string('bank_ifsc_code');
            $table->string('bank_micr_code');
            
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('account_type');
            $table->string('proof_of_bank_account_ownership_file_name');
            $table->string('proof_of_bank_account_ownership_file_path');
            $table->string('profile_pic')->default('img/default_profile_pic.png');

            $table->string('is_active')->default('1');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties_informations');
    }
};
