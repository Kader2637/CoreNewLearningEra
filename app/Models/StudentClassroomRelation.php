<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClassroomRelation extends Model
{
    /** @use HasFactory<\Database\Factories\StudentClassroomRelationFactory> */
    use HasFactory;

    protected $guarded = ['id'];
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
