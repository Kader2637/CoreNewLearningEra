<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user()->id;  // Mengakses ID pengguna yang sedang login
        dd($user);  // Menampilkan ID pengguna
    }
    public function checkAuth(Request $request)
    {
        if ($request->user()) {
            return response()->json([
                'status' => 'success',
                'user' => $request->user(),
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function testEmail()
    {
        Mail::to('ivanudahgede@gmail.com')->send(new TestEmail());
        return response()->json(['message' => 'Email berhasil dikirim']);
    }
}
