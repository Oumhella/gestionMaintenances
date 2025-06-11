<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('eau', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('due_date')->nullable();
            $table->double('volume')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('task_id')->constrained('eau_tasks')->onDelete('cascade');
            $table->enum('task_status', ['bien', 'moyen', 'panne', 'fait', 'pas fait']);
            $table->string('form_type'); // Store the form type
            $table->string('image')->nullable();  // Add this column if not present
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eau');
    }
};
