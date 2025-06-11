<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGtcTasksTable extends Migration
{
    public function up()
    {
        Schema::create('gtc_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('checkbox_options');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gtc_tasks');
    }
}
