<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormTypeToCoffretsInformatiqueTable extends \Illuminate\Database\Migrations\Migration
{
    public function up()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (!Schema::hasColumn('coffrets_informatique', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
        Schema::table('gtc', function (Blueprint $table) {
            if (!Schema::hasColumn('gtc', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
        Schema::table('eau', function (Blueprint $table) {
            if (!Schema::hasColumn('eau', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
        Schema::table('ge', function (Blueprint $table) {
            if (!Schema::hasColumn('ge', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
        Schema::table('pcs', function (Blueprint $table) {
            if (!Schema::hasColumn('pcs', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
        Schema::table('electrique', function (Blueprint $table) {
            if (!Schema::hasColumn('electrique', 'form_type')) {
                $table->string('form_type')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            if (Schema::hasColumn('coffrets_informatique', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
        Schema::table('gtc', function (Blueprint $table) {
            if (Schema::hasColumn('gtc', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
        Schema::table('eau', function (Blueprint $table) {
            if (Schema::hasColumn('eau', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
        Schema::table('ge', function (Blueprint $table) {
            if (Schema::hasColumn('ge', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
        Schema::table('pcs', function (Blueprint $table) {
            if (Schema::hasColumn('pcs', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
        Schema::table('electrique', function (Blueprint $table) {
            if (Schema::hasColumn('electrique', 'form_type')) {
                $table->dropColumn('form_type');
            }
        });
    }
}
