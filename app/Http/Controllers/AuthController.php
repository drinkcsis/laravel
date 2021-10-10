<?php

namespace App\Http\Controllers;
use App\Facades\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;


class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = TokenService::genToken($validator->validated());

        $this->storeToken($request, $token);

        sleep(2);

        return response()->json([
            'access_token' => $token,
            'user' => auth()->user()
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse {
        $request->session()->forget('token');

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Save token to session.
     *
     * @param Request $request
     * @param string $token
     *
     * @return void
     */
    protected function storeToken(Request $request, string $token): void {
        $request->session()->put('token', $token);
    }

}
