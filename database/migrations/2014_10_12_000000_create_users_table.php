<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->date('join_date')->default(date("Y-m-d H:i:s"));
            $table->date('last_login_date')->default(date("Y-m-d H:i:s"));
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('fullname')->nullable();
        //     $table->string('username');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->date('join_date')->default(date("Y-m-d H:i:s"));
        //     $table->date('last_login_date')->default(date("Y-m-d H:i:s"));
        //     $table->string('status')->default("active");
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
