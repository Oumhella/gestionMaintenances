<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskIdToCoffretsInformatiqueAndOtherTables extends Migration
{
    public function up()
    {
        // Adding task_id to form_data table
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (!Schema::hasColumn('coffrets_informatique', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });

        // Adding task_id to gtc_form table
        Schema::table('gtc', function (Blueprint $table) {
            if (!Schema::hasColumn('gtc', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });

        Schema::table('eau', function (Blueprint $table) {
            if (!Schema::hasColumn('eau', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
        Schema::table('ge', function (Blueprint $table) {
            if (!Schema::hasColumn('ge', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
        Schema::table('pcs', function (Blueprint $table) {
            if (!Schema::hasColumn('pcs', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
        Schema::table('electrique', function (Blueprint $table) {
            if (!Schema::hasColumn('electrique', 'task_id')) {
                $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        // Dropping task_id from form_data table
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (Schema::hasColumn('coffrets_informatique', 'task_id')) {
                $table->dropForeign(['task_id']);
                $table->dropColumn('task_id');
            }
        });

        // Dropping task_id from gtc_form table
        Schema::table('gtc', function (Blueprint $table) {
            if (Schema::hasColumn('gtc', 'task_id')) {
                $table->dropForeign(['task_id']);
                $table->dropColumn('task_id');
            }
        });

        Schema::table('eau', function (Blueprint $table) {
            if (Schema::hasColumn('eau', 'task_id')) {
                $table->dropForeign(['task_id']);
                $table->dropColumn('task_id');
            }
        });

        Schema::table('ge', function (Blueprint $table) {
            if (Schema::hasColumn('ge', 'task_id')) {
                $table->dropForeign(['task_id']);
                $table->dropColumn('task_id');
            }
        });
        Schema::table('pcs', function (Blueprint $table) {
            if (Schema::hasColumn('pcs', 'task_id')) {
                $table->dropForeign(['task_id']);
                $table->dropColumn('task_id');
            }
        });


    }
}
