<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseTeacherController extends Controller
{
    public function show($id)
    {
        return view('pages.teacher.course.index' , compact('id'));
    }

    public function courseClass($id)
    {
        $courses = Course::where('classroom_id' , $id)->get();
        return response()->json([
            'status' => true,
            'data' => $courses,
        ],200);
    }

    public function showPage($id){
        
        return view('pages.teacher.course.detail', compact('id'));
    }

}
