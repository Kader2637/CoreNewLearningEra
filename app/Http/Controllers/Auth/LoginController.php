<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Mail\ConfirmationAddTeacherRegis;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
            'status' => 'pending',
            'image' => $request->file('image')->store('images'),
        ]);
        Mail::to($request->email)->send(new ConfirmationAddTeacherRegis());
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);
    }

   public function registerStudent(Request $request)
    {
    try {
        // 1. Validasi Manual agar bisa kontrol respon error 100%
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'no_telephone' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh pengembang lain.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'image.max' => 'Ukuran foto maksimal adalah 2MB.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(), // Ambil error pertama saja agar user tidak pusing
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Simpan Gambar dengan path yang rapi
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users/profiles', 'public');
        }

        // 3. Eksekusi Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'gender' => $request->gender,
            'no_telephone' => $request->no_telephone,
            'status' => 'accept', // Langsung aktif atau sesuaikan ke 'pending' jika butuh verifikasi admin
            'image' => $imagePath
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Akun pengembang Anda berhasil dibuat!',
            'redirect' => url('/login'), // Beritahu JS kemana harus pergi
            'data' => $user
        ], 201);

    } catch (\Exception $e) {
        // Jika ada error database atau server lainnya
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
        ], 500);
    }
}

   public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|max:225',
        'password' => 'required|min:6|max:225',
    ], [
        'email.required' => 'Masukkan Email Anda!',
        'password.required' => 'Masukkan Kata Sandi Anda!',
        'password.min' => 'Password minimal 6 karakter!',
    ]);

    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status === 'pending') {
            Auth::logout();
            $msg = 'Harap tunggu konfirmasi dari admin.';
            return $request->ajax() 
                ? response()->json(['status' => 'warning', 'message' => $msg], 403)
                : redirect()->route('login')->with('warning', $msg);
        }

        if ($user->status === 'reject') {
            Auth::logout();
            $msg = 'Anda diblokir dari sistem.';
            return $request->ajax() 
                ? response()->json(['status' => 'error', 'message' => $msg], 403)
                : redirect()->route('login')->with('error', $msg);
        }

        if ($user->status === 'accept') {
            $redirectTo = match($user->role) {
                'admin'   => '/admin/dashboard',
                'student' => '/student/dashboard',
                'teacher' => '/teacher',
                default   => '/',
            };

            if ($request->ajax() || $request->is('api/*')) {
                $token = $user->createToken('MyApp')->plainTextToken;
                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Login berhasil!',
                    'user'     => $user,
                    'token'    => $token,
                    'redirect' => $redirectTo
                ], 200);
            }

            return redirect()->intended($redirectTo);
        }
    }

    $failMsg = 'Email atau password yang Anda masukkan salah.';
    if ($request->ajax()) {
        return response()->json(['status' => 'error', 'message' => $failMsg], 401);
    }

    return redirect()->route('login')->with('error', $failMsg);
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
