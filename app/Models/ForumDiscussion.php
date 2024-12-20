<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumDiscussion extends Model
{
    /** @use HasFactory<\Database\Factories\ForumDiscussionFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
