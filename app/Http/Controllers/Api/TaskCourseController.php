<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskCourse;
use App\Http\Requests\StoreTaskCourseRequest;
use App\Http\Requests\UpdateTaskCourseRequest;

class TaskCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $taskCourse = TaskCourse::where('course_id' , $id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $taskCourse
        ],200);
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
    public function store(StoreTaskCourseRequest $request)
    {
        $taskCourse = TaskCourse::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambah tugas',
            'data' => $taskCourse
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskCourse $taskCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskCourse $taskCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskCourseRequest $request, TaskCourse $taskCourse)
    {
        $taskCourse->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengedit tugas',
            'data' => $taskCourse
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskCourse $taskCourse)
    {
        $taskCourse->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus tugas',
            'data' => $taskCourse
        ],200);
    }
}
