<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pcs', function (Blueprint $table) {
            if (!Schema::hasTable('pcs')) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('due_date')->nullable();
                $table->text('description')->nullable();
                $table->foreignId('task_id')->constrained('pcs_tasks')->onDelete('cascade');
                $table->enum('task_status', ['bien', 'moyen', 'panne', 'fait', 'pas fait'])->nullable();
                $table->string('form_type');
                $table->string('image')->nullable();
                $table->timestamps();
            }
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('pcs');
    }
};
