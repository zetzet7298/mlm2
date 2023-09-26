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
            $table->uuid('id');
            $table->primary('id');
            $table->smallInteger('level')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password2')->nullable();
            $table->text('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->rememberToken();
            $table->uuid('sponsor_id')->nullable();
            $table->string('type', 30)->default('free');
            $table->double('coin')->default(0);
            $table->double('commissions')->default(0);
            $table->tinyInteger('state')->default(0);
            $table->uuid('direct_user_id')->nullable();
            $table->uuid('indirect_user_id')->nullable();
            $table->foreign('direct_user_id')->references('id')->on('users');
            $table->foreign('indirect_user_id')->references('id')->on('users');
            $table->timestamps();
        });
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
