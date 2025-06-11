<?php
// database/migrations/xxxx_xx_xx_create_common_form_data_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('common_form_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
            $table->string('name');
            $table->string('fonction');
            $table->date('due_date');
            $table->string('equipement');
            $table->string('form_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('common_form_data');
    }
}
