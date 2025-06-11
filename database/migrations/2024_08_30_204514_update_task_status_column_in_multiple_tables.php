<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTaskStatusColumnInMultipleTables extends Migration
{
    public function up()
    {
        // Update task_status in form_data table
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });

        // Update task_status in ge_form table
//        Schema::table('ge_form', function (Blueprint $table) {
//            $table->string('task_status', 50)->change();
//        });

        // Update task_status in gtc_form table
        Schema::table('gtc', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });
        Schema::table('eau', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });

        Schema::table('ge', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });
        Schema::table('pcs', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });
        Schema::table('electrique', function (Blueprint $table) {
            $table->string('task_status', 50)->change();
        });
    }

    public function down()
    {
        // Revert task_status in coffrets_informatique table
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });
        Schema::table('eau', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });

        // Revert task_status in ge_form table
//        Schema::table('ge_form', function (Blueprint $table) {
//            $table->string('task_status', 20)->change();
//        });

        // Revert task_status in gtc_form table
        Schema::table('gtc', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });
//        Schema::table('eau', function (Blueprint $table) {
//            $table->string('task_status', 20)->change();
//        });
        Schema::table('ge', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });
        Schema::table('pcs', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });
        Schema::table('electrique', function (Blueprint $table) {
            $table->string('task_status', 20)->change();
        });
    }
}
