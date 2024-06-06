<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id('conversation_id');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->date('conversation_date');
            $table->text('conversation_content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
