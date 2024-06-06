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
            $table->string('user_type'); // Column to distinguish user type
            $table->string('account_username');
            $table->string('account_password');
            $table->string('role');
            $table->timestamps();

            // Adding index for the polymorphic relationship
            $table->index(['user_id', 'user_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
