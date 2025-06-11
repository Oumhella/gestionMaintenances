<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcsTask extends Model
{
protected $table = 'pcs_tasks';
    protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];
}
