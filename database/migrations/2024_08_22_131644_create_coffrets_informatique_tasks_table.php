<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoffretsInformatiqueTasksTable extends Migration
{
    public function up()
    {
        Schema::create('coffrets_informatique_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('checkbox_options')->default('default');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coffrets_informatique_tasks');
    }
}
