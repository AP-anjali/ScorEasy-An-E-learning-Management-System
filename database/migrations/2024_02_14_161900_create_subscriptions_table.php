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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('system_administration')->onDelete('cascade');
            $table->string('subscription_name');
            $table->string('subscription_title');
            $table->text('subscription_discription');
            $table->string('subscription_price_without_discount');
            $table->string('subscription_price_with_discount');
            $table->string('subscription_duration_number');
            $table->string('subscription_duration_unit');
            $table->string('full_subscription_duration');

            $table->string('View_Videos_and_PDFs_access_boolean');
            $table->string('View_Videos_and_PDFs_access_limitation')->nullable();
            $table->string('View_Videos_and_PDFs_access_limitation_number')->nullable();

            $table->string('Download_Videos_and_PDFs_access_boolean');
            $table->string('Download_Videos_and_PDFs_access_limitation')->nullable();
            $table->string('Download_Videos_and_PDFs_access_limitation_number')->nullable();

            $table->string('Exams_access_boolean');
            $table->string('Exams_access_limitation')->nullable();
            $table->string('Exams_access_limitation_number')->nullable();

            $table->string('subscription_bg_color');
            $table->string('subscription_thumnail_image');
            $table->string('subscription_bg_pic');
            $table->enum('subscription_status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
