<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EauTask extends Model
{
    protected $table = 'eau_tasks';
    protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];
}
