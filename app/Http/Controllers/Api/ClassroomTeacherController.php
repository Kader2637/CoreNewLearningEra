<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AcceptStudent;
use App\Models\Classroom;
use App\Models\StudentClassroomRelation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClassroomTeacherController extends Controller
{
    public function show(Classroom $classroom)
    {
        $classroom = $classroom->where('id', $classroom->id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $classroom
        ], 200);
    }

    public function pendingStudent($id)
    {
        $pending = StudentClassroomRelation::where('classroom_id', $id)
            ->where('status', 'pending')
            ->get();

        $result = $pending->map(function ($relation) {
            $user = $relation->user;

            return [
                'id_relation' => $relation->id,
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->image,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $result
        ], 200);
    }

    public function accept($user_id)
    {
        $accept = StudentClassroomRelation::where('user_id', $user_id)->first();

        if (!$accept) {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa tidak ditemukan dalam kelas'
            ], 404);
        }

        $classroom = Classroom::find($accept->classroom_id);

        if (!$classroom) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kelas tidak ditemukan'
            ], 404);
        }

        if ($classroom->total_user >= $classroom->limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kelas sudah penuh. Tidak dapat menerima siswa.'
            ], 400);
        }
        $user = User::where('id' , $user_id)->first();
        Mail::to($user->email)->send(new AcceptStudent());

        $accept->status = 'accept';
        $accept->save();

        $classroom->total_user = $classroom->total_user + 1;
        $classroom->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Siswa berhasil diterima.'
        ], 200);
    }



    public function reject($user_id)
    {
        $accept = StudentClassroomRelation::where('user_id', $user_id)->first();

        $accept->status = 'reject';
        $accept->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Student rejected'
        ], 200);
    }
}
