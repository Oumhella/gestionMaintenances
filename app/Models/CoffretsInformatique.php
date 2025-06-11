<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoffretsInformatique extends Model
{
    protected $table = 'coffrets_informatique';
    protected $fillable = [
        'user_id', 'due_date', 'input_220VAC', 'input_24VDC', 'description', 'task_id', 'task_status', 'form_type', 'image','common_data_id'
    ];

    // Relationship with CoffretsInformatiqueTask
    public function task()
    {
        return $this->belongsTo(CoffretsInformatiqueTask::class, 'task_id');
    }

    // Relationship with images (assuming task_id links images)
    public function images()
    {
        return $this->hasMany(Image::class, 'task_id', 'task_id')->where('form_type', 'coffrets_informatique');
    }
    public function commonData()
    {
        return $this->belongsTo(CommonFormData::class);
    }
}
