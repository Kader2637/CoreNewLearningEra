<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\StudentClassroomRelation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function approvalClass() {
        $classroom = Classroom::with('user')->where('status', 'pending')->get();

        $formattedClassroom = $classroom->map(function($class) {
            return [
                'id' => $class->id,
                'name' => $class->name,
                'codeClass' => $class->codeClass,
                'limit' => $class->limit,
                'total_user' => $class->total_user,
                'description' => $class->description,
                'thumbnail' => $class->thumbnail,
                'status' => $class->status,
                'statusClass' => $class->statusClass,
                'user' => $class->user->name,
                'profile' => $class->user->image,
                'created_at' => $class->created_at,
                'updated_at' => $class->updated_at,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedClassroom
        ], 200);
    }

    public function acceptClass($id)
    {
        $classroom = Classroom::where('id', $id)->first();
        $classroom->status = 'accept';
        $classroom->save();
        return response()->json([
            'status' => true,
            'message' => 'Kelas berhasil diterima.'
        ]);
    }
    public function rejectClass($id)
    {
        $classroom = Classroom::where('id', $id)->first();
        $classroom->status = 'reject';
        $classroom->save();
        return response()->json([
            'status' => true,
            'message' => 'Kelas berhasil diterima.'
        ]);
    }
    public function countAdmin()
    {
        $countClassroom = Classroom::where('status' , 'accept')->count();
        $countTeacher = User::where('role', 'teacher')->where('status' , 'accept')->count();
        $countStudent = User::where('role', 'student')->where('status' , 'accept')->count();
        $countCourse = User::where('role', 'student')->where('status' , 'accept')->count();
        return response()->json([
            'status' => 'success',
            'countClassroom' => $countClassroom,
            'countTeacher' => $countTeacher,
            'countStudent' => $countStudent,
            'countCourse' => $countCourse
        ],200);
    }
}
