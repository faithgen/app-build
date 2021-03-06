<?php

use Faithgen\AppBuild\Models\Build;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fg_app_builds', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('ministry_id', 150)->index();
            $table->string('version');
            $table->enum('status', Build::BUILD_STATUS)->default('building');
            $table->timestamps();

            $table->foreign('ministry_id')->references('id')->on('fg_ministries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fg_app_builds');
    }
}
