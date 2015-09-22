<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->integer('pub_id')->unsigned();
            $table->foreign('pub_id')->references('id')->on('pubs')->onDelete('cascade');
            $table->integer('run_id')->unsigned();
            $table->foreign('run_id')->references('id')->on('press_runs')->onDelete('cascade');
            $table->integer('equipment_id')->unsigned()->default(0);
            $table->integer('tied_to_id')->unsigned()->default(0);
            $table->integer('recurrence_id')->unsigned()->default(0);
            $table->date('product_date')->nullable();
            $table->date('request_date')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('type')->default('press');
            $table->string('source')->default('system');
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
