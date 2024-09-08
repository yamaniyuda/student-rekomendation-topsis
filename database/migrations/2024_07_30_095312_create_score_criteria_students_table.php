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
        Schema::create('score_criteria_students', function (Blueprint $table) {
            $table->foreignUuid('student_score_id')->references('id')->on('student_scores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('criteria_detail_id')->references('id')->on('criteria_details')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['student_score_id', 'criteria_detail_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_criteria_students');
    }
};
