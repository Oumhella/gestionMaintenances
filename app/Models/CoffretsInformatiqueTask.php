<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoffretsInformatiqueTask extends Model
{
    protected $table = 'coffrets_informatique_tasks';
    protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];
}
