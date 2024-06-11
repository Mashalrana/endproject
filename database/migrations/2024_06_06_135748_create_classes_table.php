<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Dit zorgt voor een auto-incrementing 'id' kolom
            $table->string('class_name');
            $table->unsignedBigInteger('mentor');
            $table->timestamps();

            $table->foreign('mentor')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
