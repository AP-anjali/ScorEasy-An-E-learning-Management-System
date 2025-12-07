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
        Schema::create('subjects_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('system_administration')->onDelete('cascade');
            $table->string('selected_course_name');
            $table->unsignedBigInteger('selected_course_id');
            $table->foreign('selected_course_id')->references('id')->on('courses_info')->onDelete('cascade');  
            $table->string('subject_name');
            $table->text('subject_description');
            $table->boolean('tc')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects_info');
    }
};
