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
        Schema::table('pcs', function (Blueprint $table) {
            if (!Schema::hasColumn('pcs', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('pcs', function (Blueprint $table) {
            if (Schema::hasColumn('pcs', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
