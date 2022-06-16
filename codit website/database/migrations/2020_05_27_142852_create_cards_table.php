<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auther_id')->nullable();
            $table->string('icon')->nullable()->default("");
            $table->string('title',20)->nullable()->default("");
            $table->string('desc')->nullable()->default("");
            $table->string('title_ar',20)->nullable()->default("");
            $table->string('desc_ar')->nullable()->default("");

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
        Schema::dropIfExists('cards');
    }
}
