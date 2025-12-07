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
        Schema::create('video_tutorials_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties_informations')->onDelete('cascade');
            $table->string('video_tutorial_url');
            $table->string('video_tutorial_Thumbnail_Image');
            $table->string('video_tutorial_title');
            $table->text('video_tutorial_description');
            $table->unsignedBigInteger('video_tutorial_selected_Language_id');
            $table->foreign('video_tutorial_selected_Language_id')->references('id')->on('languages_info')->onDelete('cascade');
            $table->string('video_tutorial_selected_Language');
            $table->text('video_tutorial_keywords_or_tags');
            $table->unsignedBigInteger('video_tutorial_selected_course_id');
            $table->foreign('video_tutorial_selected_course_id')->references('id')->on('courses_info')->onDelete('cascade');
            $table->string('video_tutorial_selected_course_name');
            $table->unsignedBigInteger('video_tutorial_selected_subject_id');
            $table->foreign('video_tutorial_selected_subject_id')->references('id')->on('subjects_info')->onDelete('cascade');
            $table->string('video_tutorial_selected_subject_name');
            $table->enum('video_tutorial_status', ['active', 'inactive'])->default('active');
            $table->string('video_tutorial_Duration_in_time');
            $table->string('video_tutorial_file_size');
            $table->boolean('tc')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_tutorials_info');
    }
};
