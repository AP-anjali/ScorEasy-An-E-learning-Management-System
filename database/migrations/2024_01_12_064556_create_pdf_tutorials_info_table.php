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
        Schema::create('pdf_tutorials_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties_informations')->onDelete('cascade');
            $table->string('PDF_tutorial_path'); 
            $table->string('PDF_tutorial_Thumbnail_Image'); 
            $table->string('PDF_tutorial_title');
            $table->text('PDF_tutorial_description');
            $table->unsignedBigInteger('PDF_tutorial_selected_Language_id');
            $table->foreign('PDF_tutorial_selected_Language_id')->references('id')->on('languages_info')->onDelete('cascade');
            $table->string('PDF_tutorial_selected_Language');
            $table->text('PDF_tutorial_keywords_or_tags');
            $table->unsignedBigInteger('PDF_tutorial_selected_course_id');
            $table->foreign('PDF_tutorial_selected_course_id')->references('id')->on('courses_info')->onDelete('cascade');
            $table->string('PDF_tutorial_selected_course_name');
            $table->unsignedBigInteger('PDF_tutorial_selected_subject_id');
            $table->foreign('PDF_tutorial_selected_subject_id')->references('id')->on('subjects_info')->onDelete('cascade');
            $table->string('PDF_tutorial_selected_subject_name');
            $table->enum('PDF_tutorial_status', ['active', 'inactive'])->default('active');
            $table->integer('PDF_tutorial_page_numbers'); 
            $table->string('PDF_tutorial_file_size'); 
            $table->boolean('tc')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_tutorials_info');
    }
};
