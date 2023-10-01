<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal', function (Blueprint $table) {
            $table->id();
            // $table->uuid('user_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->double('coin');
            $table->string('address', 50)->nullable();
            $table->string('method', 50)->nullable();
            $table->string('content', 255)->nullable();
            $table->boolean('is_received')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('withdrawal');
    }
}
