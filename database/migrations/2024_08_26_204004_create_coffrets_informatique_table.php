<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coffrets_informatique', function (Blueprint $table) {
            if (!Schema::hasTable('coffrets_informatique')) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('due_date')->nullable();
                $table->decimal('input_220VAC', 8, 2)->nullable();
                $table->decimal('input_24VDC', 8, 2)->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('task_id');
                $table->foreign('task_id')->references('id')->on('coffrets_informatique_tasks')->onDelete('cascade');
                $table->enum('task_status', ['bien', 'moyen', 'panne', 'fait', 'pas fait'])->nullable();
                $table->string('form_type');
                $table->string('image')->nullable();
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coffrets_informatique');
    }
};
