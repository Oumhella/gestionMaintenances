<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToCoffretsInformatiqueTable extends \Illuminate\Database\Migrations\Migration
{
    public function up()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (!Schema::hasColumn('coffrets_informatique', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (Schema::hasColumn('coffrets_informatique', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}
