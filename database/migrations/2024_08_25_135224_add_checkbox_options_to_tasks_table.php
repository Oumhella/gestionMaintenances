<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckboxOptionsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('coffrets_informatique_tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('coffrets_informatique_tasks', 'checkbox_options')) {
                $table->string('checkbox_options')->default('default');
            }
        });
    }

    public function down()
    {
        Schema::table('coffrets_informatique_tasks', function (Blueprint $table) {
            $table->dropColumn('checkbox_options');
        });
    }
}
