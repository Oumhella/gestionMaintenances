<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['user_id', 'task_id', 'form_type', 'image'];

    // Relationship with User
//    private mixed $task;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with CoffretsInformatiqueTask
    // In Image.php model
    public function task()
    {
        // Assuming the task model names are CoffretsInformatiqueTask and GtcTask
        if ($this->form_type === 'coffrets_informatique') {
            return $this->belongsTo(CoffretsInformatiqueTask::class, 'task_id');
        } elseif ($this->form_type === 'gtc') {
            return $this->belongsTo(GtcTask::class, 'task_id');
        }elseif ($this->form_type === 'comptage_eau') {
            return $this->belongsTo(EauTask::class, 'task_id');
        }elseif ($this->form_type === 'ge') {
            return $this->belongsTo(GETask::class, 'task_id');
        }elseif ($this->form_type === 'pcs') {
            return $this->belongsTo(PcsTask::class, 'task_id');
        }

        // Add other conditions as needed
        return null;
    }

    public function getTaskName()
    {
        $task = $this->task;
        return $task ? $task->name : 'N/A'; // Adjust 'name' if your task model uses a different field
    }
}
