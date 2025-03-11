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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->enum('type', ['MCQ', 'Text', 'Numeric'])->default('MCQ');
            $table->enum('category', ['umum', 'spesifik'])->default('umum');
            $table->unsignedBigInteger('major_id')->nullable();
            $table->timestamps();

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};