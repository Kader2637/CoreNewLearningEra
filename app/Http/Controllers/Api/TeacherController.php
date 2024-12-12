<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function count($id)
    {
        $countTeacher = User::where('role', 'teacher')
        ->where('status', 'accept')
        ->count();
        $countClassroom = Classroom::where('user_id', $id)->count();


        return response()->json([
            'status' => 'success',
            'countTeacher' => $countTeacher,
            'countClassroom' => $countClassroom,
        ],200);
    }

    public function countCourse($id)
    {
    }
}
