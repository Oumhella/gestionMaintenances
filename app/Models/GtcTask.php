<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GtcTask extends Model
{
    protected $table ='gtc_tasks';
       protected $fillable = [
        'name', // Assuming the task has a 'name' field
    ];
}

