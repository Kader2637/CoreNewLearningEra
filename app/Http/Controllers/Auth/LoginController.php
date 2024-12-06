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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['role'] = $user->role;
            $success['status'] = $user->status;

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'User login successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised',
                'error' => ['error' => 'Unauthorised']
            ], 401);
        }
    }

    public function ApiLogout(Request $request)
    {
        Auth::guard('api')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Anda telah berhasil logout.'
        ]);
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
