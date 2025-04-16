<?php

// database/migrations/xxxx_xx_xx_create_question_answers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('value')->nullable(); // untuk boolean: 1 = Ya, 0 = Tidak
            $table->foreignId('option_id')->nullable()->constrained('question_options')->onDelete('set null'); // untuk soal mini
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_answers');
    }
};