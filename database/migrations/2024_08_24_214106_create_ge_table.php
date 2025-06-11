<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ge', function (Blueprint $table) {
            if (!Schema::hasTable('ge')) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('due_date')->nullable();
                $table->decimal('input_220VAC', 8, 2)->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('task_id');
                $table->foreign('task_id')->references('id')->on('ge_tasks')->onDelete('cascade');
                $table->enum('task_status', ['bien', 'moyen', 'panne', 'fait', 'pas fait'])->nullable();
                $table->string('form_type');
                $table->string('image')->nullable();
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ge');
    }
};
