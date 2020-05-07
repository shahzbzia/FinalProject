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
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('userName')->unique();
            $table->date('birthDate');
            $table->text('aboutMe')->nullable();
            $table->string('email')->unique();
            $table->string('countryCode');
            $table->bigInteger('number')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('coverImage')->nullable();
            $table->string('profession')->nullable();
            $table->text('address');
            $table->foreignId('theme_id');
            $table->foreignId('gender_id');
            $table->foreignId('role_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
