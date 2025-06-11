<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('start')->nullable(); // Allow null if not always set
            $table->timestamp('end')->nullable();   // Allow null if not always set
            $table->timestamps();
        });
    }


public function down(): void
{
Schema::dropIfExists('events');
}
}
