<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function teacher()
    {
        $user = User::where('role', 'teacher')->where('status', 'pending')->get();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ],200);
    }

}
