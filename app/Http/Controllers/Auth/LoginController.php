<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function test()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User login successfully.'
        ], 200);
    }


    public function registerTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'school' => 'required|string',
            'nip' => 'required|numeric',
            'address' => 'required|string',
            'no_telephone' => 'required|numeric',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email sudah terdaftar.'
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'gender' => $request->gender,
            'school' => $request->school,
            'nip' => $request->nip,
            'address' => $request->address,
            'no_telephone' => $request->no_telephone,
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'no_telephone' => 'required|numeric',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email sudah terdaftar.'
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'gender' => $request->gender,
            'no_telephone' => $request->no_telephone,
            'status' => 'accept'
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'email' => 'required|exists:users,email|max:225',
            'password' => 'required|min:6|max:225',
        ], [
            'email.max' => 'Masukan 225 karakter!',
            'password.max' => 'Masukan 225 karakter!',
            'email.required' => 'Masukkan Email Anda !!',
            'email.exists' => 'Email Yang Anda Masukkan Belum Terdaftar !!',
            'password.required' => 'Masukkan Kata Sandi Anda !!',
            'password.min' => 'Password Minimal 6 Huruf !!',
        ]);

        // Ambil kredensial dari input
        $credentials = $request->only('email', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek status pengguna
            if ($user->status === 'pending') {
                Auth::logout(); // Logout pengguna jika status pending
                return redirect()->route('login')->with('warning', 'Harap tunggu konfirmasi dari admin.');
            } elseif ($user->status === 'reject') {
                Auth::logout(); // Logout pengguna jika status ditolak
                return redirect()->route('login')->with('error', 'Anda diblokir dari sistem.');
            } elseif ($user->status === 'accept') {
                // Buat token untuk pengguna
                $token = $user->createToken('MyApp')->plainTextToken;

                // Siapkan respons
                $response = [
                    'status' => 'success',
                    'user' => $user,
                    'token' => $token, // Tambahkan token ke respons
                ];

                // Jika permintaan dari API, kembalikan JSON
                if ($request->is('api/*')) {
                    return response()->json($response);
                }

                // Jika bukan permintaan API, lakukan redirect sesuai role
                switch ($user->role) {
                    case 'admin':
                        return redirect('/admin/dashboard');
                    case 'student':
                        return redirect('/student/dashboard');
                    case 'teacher':
                        return redirect('/teacher');
                    default:
                        return redirect('/login');
                }
            }
        }

        // Jika autentikasi gagal
        return redirect()->route('login')->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Anda telah berhasil logout.');
    }
    public function accept(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 'accept';
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'User berhasil diterima.'
        ]);
    }
    public function reject(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 'reject';
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'User berhasil diterima.'
        ]);
    }
}