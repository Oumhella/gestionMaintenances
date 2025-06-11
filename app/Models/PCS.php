<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PCS extends Model
{
    protected $table = 'pcs';

    protected $fillable = [
        'user_id', 'due_date', 'description', 'task_id', 'task_status', 'form_type', 'image','common_data_id'
    ];

    public function task()
    {
        return $this->belongsTo(PcsTask::class, 'task_id');
    }

    // Relationship with images (assuming task_id links images)
    public function images()
    {
        return $this->hasMany(Image::class, 'task_id', 'task_id')->where('form_type', 'pcs');
    }
    public function commonData()
    {
        return $this->belongsTo(CommonFormData::class);
    }
}
