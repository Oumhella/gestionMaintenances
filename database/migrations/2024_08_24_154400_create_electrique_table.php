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
        Schema::create('electrique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('due_date')->nullable();
            $table->decimal('V1', 8, 2)->nullable();
            $table->decimal('V2', 8, 2)->nullable();
            $table->decimal('V3', 8, 2)->nullable();
            $table->decimal('U12', 8, 2)->nullable();
            $table->decimal('U23', 8, 2)->nullable();
            $table->decimal('U31', 8, 2)->nullable();
            $table->decimal('I1', 8, 2)->nullable();
            $table->decimal('I2', 8, 2)->nullable();
            $table->decimal('I3', 8, 2)->nullable();
            $table->decimal('Puissance_active_Total', 8, 2)->nullable();
            $table->decimal('Puissance_reactive_Total', 8, 2)->nullable();
            $table->decimal('Puissance_apparente_Total', 8, 2)->nullable();
            $table->decimal('Energie_Active', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('task_id')->constrained('electrique_tasks')->onDelete('cascade');
            $table->enum('task_status', ['bien', 'moyen', 'panne', 'fait', 'pas fait'])->nullable();
            $table->string('form_type');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electrique', function (Blueprint $table) {
            //
        });
    }
};
