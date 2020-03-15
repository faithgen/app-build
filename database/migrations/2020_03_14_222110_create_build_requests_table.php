<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_requests', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('ministry_id', 150)->index();
            $table->boolean('release');
            $table->boolean('processing')->default(false);
            $table->boolean('processed')->default(false);
            $table->timestamps();

            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('build_requests');
    }
}
