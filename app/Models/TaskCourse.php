<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCourse extends Model
{
    /** @use HasFactory<\Database\Factories\TaskCourseFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}