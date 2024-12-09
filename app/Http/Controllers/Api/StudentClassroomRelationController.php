<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClassroomRelation;
use App\Http\Requests\StoreStudentClassroomRelationRequest;
use App\Http\Requests\UpdateStudentClassroomRelationRequest;
use App\Models\Classroom;

class StudentClassroomRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $StudentClassroomRelations = StudentClassroomRelation::where('user_id', $id)->where('status', 'accept')->get();

        if ($StudentClassroomRelations->isNotEmpty()) {
            $formattedData = $StudentClassroomRelations->map(function ($relation) {
                return [
                    'status' => $relation->status,
                    'course' => [
                        'id' => $relation->classroom->id,
                        'name' => $relation->classroom->name,
                        'codeClass' => $relation->classroom->codeClass,
                        'limit' => $relation->classroom->limit,
                        'total_user' => $relation->classroom->total_user,
                        'description' => $relation->classroom->description,
                        'thumbnail' => $relation->classroom->thumbnail,
                        'status' => $relation->classroom->status,
                        'statusClass' => $relation->classroom->statusClass,
                        'teacher' => $relation->classroom->user->name
                    ],
                    'user' => [
                        'id' => $relation->classroom->id,
                        'name' => $relation->classroom->name,
                        'email' => $relation->classroom->email,
                        'profile' => $relation->classroom->image
                    ],
                ];
            });

            return response()->json([
                'status' => 'success',
                'StudentClassroomRelations' => $formattedData
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'StudentClassroomRelations' => []
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentClassroomRelationRequest $request)
    {
        $classroom = Classroom::where('codeClass', $request->classroom_code)
            ->first();

        if ($classroom) {
            $existingRelation = StudentClassroomRelation::where('user_id', $request->user_id)
                ->where('classroom_id', $classroom->id)
                ->first();

            if ($existingRelation) {
                return response()->json(['message' => 'Anda sudah bergabung di kelas ini.'], 400);
            }

            if ($classroom->total_user >= $classroom->limit) {
                return response()->json(['message' => 'Batas pengguna kelas telah tercapai.'], 400);
            }

            StudentClassroomRelation::create([
                'user_id' => $request->user_id,
                'classroom_id' => $classroom->id,
                'status' => 'accept',
            ]);

            $classroom->increment('total_user');

            return response()->json(['message' => 'Bergabung dengan kelas berhasil.'], 200);
        } else {
            return response()->json(['message' => 'Kode kelas atau status kelas tidak valid.'], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(StudentClassroomRelation $studentClassroomRelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClassroomRelation $studentClassroomRelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentClassroomRelationRequest $request, StudentClassroomRelation $studentClassroomRelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClassroomRelation $studentClassroomRelation)
    {
        $classroom = $studentClassroomRelation->classroom;

        if ($classroom->total_user > 0) {
            $classroom->total_user -= 1;
            $classroom->save();
        }

        $studentClassroomRelation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengeluarkan siswa.',
            'data' => $studentClassroomRelation
        ], 200);
    }

    public function joinclass(StoreStudentClassroomRelationRequest $request, $id)
    {
        $classroom = Classroom::where('id', $id)
            ->where('statusClass', 'public')
            ->first();

        if ($classroom) {
            $existingRelation = StudentClassroomRelation::where('user_id', $request->user_id)
                ->where('classroom_id', $classroom->id)
                ->first();

            if ($existingRelation) {
                return response()->json(['message' => 'Anda sudah mendaftar di kelas ini. Silakan menunggu konfirmasi dari pemilik kelas.'], 400);
            }

            $totalUsers = StudentClassroomRelation::where('classroom_id', $classroom->id)->count();
            $limit = $classroom->limit;

            if ($totalUsers < $limit) {
                StudentClassroomRelation::create([
                    'user_id' => $request->user_id,
                    'classroom_id' => $classroom->id,
                    'status' => 'pending',
                ]);
                return response()->json(['message' => 'Anda telah mendaftar di kelas ini. Silakan menunggu konfirmasi dari pemilik kelas.'], 200);
            } else {
                return response()->json(['message' => 'Batas pengguna kelas telah tercapai.'], 400);
            }
        } else {
            return response()->json(['message' => 'ID kelas atau status kelas tidak valid.'], 400);
        }
    }
}
