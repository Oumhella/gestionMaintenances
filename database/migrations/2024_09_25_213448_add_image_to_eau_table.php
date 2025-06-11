<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('eau', function (Blueprint $table) {
            if (!Schema::hasColumn('eau', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('eau', function (Blueprint $table) {
            if (Schema::hasColumn('eau', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
