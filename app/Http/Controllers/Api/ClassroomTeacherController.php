<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomTeacherController extends Controller
{
    public function show(Classroom $classroom)
    {
        $classroom = $classroom->where('user_id' , $classroom->user_id)->first();
        return response()->json([
            'status'=> 'success' ,
            'data' => $classroom
        ], 200);
    }
}
