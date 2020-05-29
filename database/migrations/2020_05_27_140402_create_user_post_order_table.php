<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPostOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_post_order', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('post_id')->unsigned()->nullable();
            $table->foreign('post_id')->references('id')
                ->on('posts')->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('user_post_order');
    }
}
