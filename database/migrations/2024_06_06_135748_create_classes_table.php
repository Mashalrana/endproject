<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing 'id' column
            $table->string('class_name');
            $table->unsignedBigInteger('mentor_id'); // Updated column name
            $table->timestamps();

            $table->foreign('mentor_id')->references('id')->on('teachers')->onDelete('cascade'); // Updated column name
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
