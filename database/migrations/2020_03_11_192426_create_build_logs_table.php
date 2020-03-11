<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_logs', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('build_id', 150)->index();
            $table->string('task');
            $table->json('result');
            $table->boolean('success');
            $table->timestamps();

            $table->foreign('build_id')->references('id')->on('app_builds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('build_logs');
    }
}
