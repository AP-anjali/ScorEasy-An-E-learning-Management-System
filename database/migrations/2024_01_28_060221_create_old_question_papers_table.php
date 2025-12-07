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
        Schema::create('old_question_papers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('system_administration')->onDelete('cascade');
            $table->string('selected_course_name');
            $table->unsignedBigInteger('selected_course_id');
            $table->foreign('selected_course_id')->references('id')->on('courses_info')->onDelete('cascade');  
            $table->string('material');
            $table->string('material_Thumbnail_Image');
            $table->string('material_title');
            $table->text('material_description');
            $table->boolean('tc')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_question_papers');
    }
};
