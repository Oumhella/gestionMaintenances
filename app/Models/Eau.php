<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eau extends Model
{

    protected $table = 'eau'; // Correct table name
    // Define the table associated with the model
    protected $fillable = [
        'user_id', 'due_date', 'volume',  'description', 'task_id', 'task_status', 'form_type', 'image','common_data_id'
    ];
    public function task()
    {
        return $this->belongsTo(EauTask::class, 'task_id');
    }

    // Relationship with images (assuming task_id links images)
    public function images()
    {
        return $this->hasMany(Image::class, 'task_id', 'task_id')->where('form_type', 'eau');
    }
    public function commonData()
    {
        return $this->belongsTo(CommonFormData::class);
    }
}
