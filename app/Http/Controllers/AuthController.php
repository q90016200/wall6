<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Log;


use App\Providers\RouteServiceProvider;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'me']]);
    }

    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'name', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'request fail'
                ], 400
            );
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);


        return response()->json(
            [
                'code' => 0,
                'user' => $user
            ]
        );

    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'password' => ['required', 'string', 'min:6'],
        // ]);
        // if ($validator->fails()) {
        //     return "fail";
        // }

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // return Auth::user();

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {


        //   return response()->json([
        //         "error" => "token fail"
        //     ], 401);
        // 确定当前用户是否已经认证
        if (Auth::check()) {
            // 获取当前通过认证的用户...
            $user = Auth::user();

            //  获取当前通过认证的用户 ID...
            $id = Auth::id();


            return response()->json([
                "user" => auth()->user()
            ]);
        } else {
            return response()->json([
                "error" => "token fail"
            ], 401);
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        if (Auth::check()) {
            auth()->logout();

            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Success logged out'
                ]
            );
        } else {
            return response("", 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
