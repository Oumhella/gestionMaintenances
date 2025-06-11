<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcsTasksTable extends Migration
{
    public function up()
    {
        Schema::create('pcs_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('checkbox_options')->default('default');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pcs_tasks');
    }
}
