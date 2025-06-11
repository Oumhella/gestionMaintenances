<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electrique extends Model
{
    protected $table = 'Electrique';
    protected $fillable=[
        'user_id', 'due_date', 'V1', 'V2', 'V3','U12', 'U23', 'U31','I1','I2', 'I3','Puissance_active_Total','Puissance_reactive_Total','Puissance_apparente_Total', 'Energie_Active', 'description', 'task_id', 'task_status', 'form_type', 'image','common_data_id'
    ];

    use HasFactory;
    public function task()
    {
        return $this->belongsTo(ElectriqueTask::class, 'task_id');
    }

    // Relationship with images (assuming task_id links images)
    public function images()
    {
        return $this->hasMany(Image::class, 'task_id', 'task_id')->where('form_type', 'comptage_electrique');
    }
    public function commonData()
    {
        return $this->belongsTo(CommonFormData::class);
    }
}

