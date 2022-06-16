<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auther_id')->nullable();
            $table->unsignedBigInteger('cati_id')->nullable();
            $table->string('title',50)->nullable();
            $table->string('title_ar',50)->nullable();
            $table->float('cost')->default(0.0);
            $table->text('desc',500)->nullable();
            $table->text('desc_ar',500)->nullable();
            $table->integer('pay_count')->default(0);
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
