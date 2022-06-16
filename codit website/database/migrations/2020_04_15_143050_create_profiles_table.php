<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('img')->nullable();
            $table->string('email',30)->nullable();
            $table->bigInteger('country')->nullable();
            $table->bigInteger('gov')->nullable();
            $table->string('district',30)->nullable();
            $table->string('browser',25)->nullable()->default('');
            $table->string('platform',25)->nullable()->default('');
            $table->text('about',500)->nullable();
            $table->string('nick_name',50)->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('q1',30)->nullable();
            $table->string('a1',30)->nullable();
            $table->string('q2',30)->nullable();
            $table->string('a2',30)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
