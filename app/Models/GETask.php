<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class GETask extends Model
{
    protected $table = 'ge_tasks'; // Correct table name
    protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];

}
