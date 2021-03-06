<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fg_ministry_modules', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('ministry_id', 150)->index();
            $table->string('module_id', 150)->index();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('ministry_id')->references('id')->on('fg_ministries')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('fg_modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fg_ministry_modules');
    }
}
