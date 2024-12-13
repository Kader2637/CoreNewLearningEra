<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function teacher()
    {
        $user = User::where('role', 'teacher')->where('status', 'pending')->get();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function teacherAll()
    {
        $user = User::where('role', 'teacher')->where('status' , 'accept')->get();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('pages.admin.teacher.detail' , compact('user'));
    }


    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $user->id,
                'message' => 'User deleted successfully.'
            ]
        ], 200);
    }
}
