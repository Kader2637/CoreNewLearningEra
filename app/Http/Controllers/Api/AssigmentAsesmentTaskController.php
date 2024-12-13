<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssigmentAsesmentTask;
use App\Http\Requests\StoreAssigmentAsesmentTaskRequest;
use App\Http\Requests\UpdateAssigmentAsesmentTaskRequest;
use Illuminate\Http\Request;

class AssigmentAsesmentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = AssigmentAsesmentTask::where('task_course_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
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
    public function store(StoreAssigmentAsesmentTaskRequest $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/assignments', 'public');
        }

        $data = AssigmentAsesmentTask::create([
            'task_course_id' => $request->task_course_id,
            'user_id' => $request->user_id,
            'link' => $request->link,
            'file' => $filePath
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengumpulkan jawaban.',
            'data' => $data
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(AssigmentAsesmentTask $assigmentAsesmentTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssigmentAsesmentTask $assigmentAsesmentTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssigmentAsesmentTaskRequest $request, AssigmentAsesmentTask $assigmentAsesmentTask)
    {
        $assigmentAsesmentTask->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengedit jawaban.',
            'data' => $assigmentAsesmentTask
        ], 200);
    }

    public function grade(Request $request, $id)
    {
        $assigmentAsesmentTask = AssigmentAsesmentTask::find($id);

        if (!$assigmentAsesmentTask) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tugas tidak ditemukan.',
            ], 404);
        }

        $validatedData = $request->validate([
            'grade' => 'required|numeric|min:0|max:100', 
        ], [
            'grade.required' => 'Nilai harus diisi.',
            'grade.numeric' => 'Nilai harus berupa angka.',
            'grade.min' => 'Nilai tidak boleh kurang dari 0.',
            'grade.max' => 'Nilai tidak boleh lebih dari 100.',
        ]);

        $assigmentAsesmentTask->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil memberikan nilai.',
            'data' => $assigmentAsesmentTask
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssigmentAsesmentTask $assigmentAsesmentTask)
    {
        $assigmentAsesmentTask->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus jawaban.',
            'data' => $assigmentAsesmentTask
        ], 200);
    }
}
