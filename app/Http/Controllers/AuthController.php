<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    private AuthService $authService;
    private SuccessResponse $successResponse;
    private FailResponse $failResponse;

    public function __construct(
        AuthService     $authService,
        SuccessResponse $successResponse,
        FailResponse    $failResponse,

    )
    {
        $this->authService = $authService;
        $this->successResponse = $successResponse;
        $this->failResponse = $failResponse;
    }

    public function login( AuthRequest $request)
    {
        try {
            $user = $this->authService->login($request->only(['email', 'password'])
            );
            return $this->successResponse->setData([
                'user' => new UserResource($user),
                'token' => $user->createToken('user')->accessToken
            ])->setMessages(
                Lang::get('Successfully logged in '),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }
}
