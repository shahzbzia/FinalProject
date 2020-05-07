<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type');
            $table->string('status');
            $table->text('description')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('updated_by')->nullable();
            $table->string('url')->nullable();
            $table->boolean('sellable')->nullable();
            $table->bigInteger('royaltyFee')->nullable();
            $table->bigInteger('price')->nullable();
            $table->uuid('download_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
