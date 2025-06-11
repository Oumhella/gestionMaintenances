<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToGtcTable extends Migration
{
    public function up()
    {
        Schema::table('gtc', function (Blueprint $table) {
            if (!Schema::hasColumn('gtc', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('gtc', function (Blueprint $table) {
            if (Schema::hasColumn('gtc', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}

