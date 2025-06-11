<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommonDataIdToCoffretsInformatiqueTable extends Migration
{
    public function up()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
        Schema::table('gtc', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
        Schema::table('ge', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
        Schema::table('pcs', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
        Schema::table('eau', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
        Schema::table('electrique', function (Blueprint $table) {
            $table->unsignedBigInteger('common_data_id')->nullable()->after('user_id');
            $table->foreign('common_data_id')->references('id')->on('common_form_data')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('coffrets_informatique', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
        Schema::table('gtc', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
        Schema::table('ge', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
        Schema::table('pcs', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
        Schema::table('eau', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
        Schema::table('electrique', function (Blueprint $table) {
            $table->dropForeign(['common_data_id']);
            $table->dropColumn('common_data_id');
        });
    }
}
