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
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('posts');
        Schema::enableForeignKeyConstraints();
    }
}
