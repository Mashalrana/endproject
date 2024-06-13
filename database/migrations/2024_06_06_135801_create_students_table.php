<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing 'id' column
            $table->string('student_name');
            $table->string('student_address');
            $table->string('student_postcode');
            $table->string('student_city');
            $table->unsignedBigInteger('class_id'); // Ensure this is correct
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade'); // Ensure this is correct
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
