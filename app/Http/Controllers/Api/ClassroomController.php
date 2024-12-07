<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    public function classroomTeacher($id)
    {
        $classroom = Classroom::where('user_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $classroom
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
    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'codeClass' => $request->codeClass,
            'limit' => $request->limit,
            'statusClass' => $request->statusClass,
            'description' => $request->description,
            'thumbnail' => $request->file('thumbnail')->store('thumbnails'),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $classroom
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return response()->json([
            'message' => 'success',
            'data' => $classroom
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        if ($request->hasFile('thumbnail')) {
            if ($classroom->thumbnail && Storage::exists('public/storage/' . $classroom->thumbnail)) {
                Storage::delete('public/storage/' . $classroom->thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('classroom-thumbnails', 'public');
        } else {
            $thumbnailPath = $classroom->thumbnail;
        }

        $classroom->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'codeClass' => $request->codeClass,
            'limit' => $request->limit,
            'statusClass' => $request->statusClass,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath
        ]);

        return response()->json([
            'message' => 'Kelas berhasil diupdate!',
            'data' => $classroom
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        // Ensure the thumbnail is deleted from the storage
        if ($classroom->thumbnail) {
            Storage::disk('public')->delete($classroom->thumbnail); // Use 'public' disk
        }

        // Delete the classroom record
        $classroom->delete();

        return response()->json([
            'message' => 'success',
            'data' => null // You can return null or adjust as needed
        ], 200);
    }
}
