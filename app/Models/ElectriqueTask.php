<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectriqueTask extends Model
{
    protected $table = 'electrique_tasks';
    protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];
}
