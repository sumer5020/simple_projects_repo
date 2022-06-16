<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auther_id')->nullable();
            $table->unsignedBigInteger('cati_id')->nullable();
            $table->string('title',50)->nullable();
            $table->text('post')->nullable();
            $table->string('title_ar',50)->nullable();
            $table->text('post_ar')->nullable();
            $table->string('media_vid')->nullable();
            $table->string('media_pic')->nullable();
            $table->string('color',7)->nullable();
            $table->integer('rate_up')->default(0);
            $table->integer('rate_down')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('portfolios');
    }
}
