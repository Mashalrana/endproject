<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->unsignedBigInteger('user_id');
            $table->string('account_username');
            $table->string('account_password');
            $table->string('role');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('user_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            $table->foreign('user_id')->references('manager_id')->on('managers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
