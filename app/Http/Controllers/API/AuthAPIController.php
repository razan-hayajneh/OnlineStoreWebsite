<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\login\RegisterAPIRequest;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthAPIController extends AppBaseController
{

    public bool $token = true;
    private ClientRepository $clientRepository;
    private UserRepository $userRepository;

    public function __construct(ClientRepository $clientRepo, UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->clientRepository = $clientRepo;
    }

    public function register(RegisterAPIRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->create($input);
        $input['user_id'] = $user->id;
        $client = $this->clientRepository->create($input);
        if ($this->token) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user]);
    }
}
