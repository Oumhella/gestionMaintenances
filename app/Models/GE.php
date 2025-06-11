<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class GE extends Model
{
    // Explicitly set the table name if it's not following Laravel's default naming convention
    protected $table = 'ge'; // Correct table name
    // Define the table associated with the model
    protected $fillable = [
        'user_id', 'due_date', 'input_220VAC',  'description', 'task_id', 'task_status', 'form_type', 'image','common_data_id'
    ];
    public function task()
    {
        return $this->belongsTo(GETask::class, 'task_id');
    }

    // Relationship with images (assuming task_id links images)
    public function images()
    {
        return $this->hasMany(Image::class, 'task_id', 'task_id')->where('form_type', 'ge');
    }
    public function commonData()
    {
        return $this->belongsTo(CommonFormData::class);
    }
}
