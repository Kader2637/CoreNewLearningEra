<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssigmentAsesmentTask extends Model
{
    /** @use HasFactory<\Database\Factories\AssigmentAsesmentTaskFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskCourse()
    {
        return $this->belongsTo(taskCourse::class);
    }
}
