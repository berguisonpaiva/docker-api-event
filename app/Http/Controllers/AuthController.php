<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\{LoginRequest, RegisterRequest};
use App\Services\AuthService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $auth)
    {
        $this->authService = $auth;
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];



        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
        
    }

    public function me()
    {

        return response()->json(auth()->user());
    }

    public function refresh(Request $request)
    {  
        $token = $request->input('access_token');    
         return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $user = $this->authService->create($input);
        return response()->json($user);
    }

    protected function respondWithToken($token)
    {
        $user = auth()->setToken($token)->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
