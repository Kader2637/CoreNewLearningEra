<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\StudentClassroomRelation;
use App\Models\User;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function show($id)
    {
        return view('pages.student.course' , compact('id'));
    }

    public function courseClass($id)
    {
        $courses = Course::where('classroom_id' , $id)->get();
        return response()->json([
            'status' => true,
            'data' => $courses,
        ],200);
    }

    public function studentCourse($id)
    {
        $students = StudentClassroomRelation::where('classroom_id', $id)
            ->with('user')
            ->get();

        $formattedData = $students->map(function ($relation) {
            $user = $relation->user;
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->image,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $formattedData,
        ], 200);
    }

    public function showstudent(Classroom $classroom)
{
    $classroom = Classroom::where('id', $classroom->id)->first();

    if ($classroom) {
        $user = User::find($classroom->user_id);
        $classroom->user = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile' => $user->image,
        ];
    }

    return response()->json([
        'status' => 'success',
        'data' => $classroom
    ], 200);
}

    public function showPage($id){

        return view('pages.student.detailMateri', compact('id'));
    }

}
