<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssigmentAsesmentTask;
use App\Http\Requests\StoreAssigmentAsesmentTaskRequest;
use App\Http\Requests\UpdateAssigmentAsesmentTaskRequest;

class AssigmentAsesmentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = AssigmentAsesmentTask::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengumpulkan jawaban.',
            'data' => $data
        ],200);
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
        ],200);
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
        ],200);
    }
}
