<?php

namespace App\Http\Controllers;

use App\Models\ForumDiscussion;
use App\Http\Requests\StoreForumDiscussionRequest;
use App\Http\Requests\UpdateForumDiscussionRequest;

class ForumDiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $forumDiscussion = ForumDiscussion::where('classroom_id' , $id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $forumDiscussion
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
    public function store(StoreForumDiscussionRequest $request)
    {
        $forumDiscussion = ForumDiscussion::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengirim pesan',
            'data' => $forumDiscussion
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumDiscussion $forumDiscussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForumDiscussion $forumDiscussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumDiscussionRequest $request, ForumDiscussion $forumDiscussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForumDiscussion $forumDiscussion)
    {
        $forumDiscussion->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus pesan',
            'data' => $forumDiscussion
        ],200);
    }
}
