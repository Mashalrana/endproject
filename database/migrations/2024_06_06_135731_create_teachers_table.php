<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Dit zorgt voor een auto-incrementing 'id' kolom
            $table->string('teacher_name');
            $table->string('teacher_address');
            $table->string('teacher_postcode');
            $table->string('teacher_city');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
