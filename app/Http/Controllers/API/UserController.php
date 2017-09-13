<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryEloquent as UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a new user
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $user = $this->repository->create($request->all());
        return response()->json(['status' => 'success', 'message' => 'User created successfully', 'data' => $user]);
    }

    /**
     * Login user with JWT
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $token = null;

        try {
            if (!$token = \JWTAuth::attempt($credentials)) {
                return response()->json(['status' => 'warning', 'msg' => 'Invalid e-mail or password'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['status' => 'warning', 'msg' => 'Failed to create the token'], 200);
        }

        $user = \JWTAuth::toUser($token);

        return response()->json(['status' => 'success', 'token' => $token, 'user' => $user]);
    }

    /**
     * Check JWT Token and refresh it if is necessary.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $token = \JWTAuth::getToken();
        try {
            $user = \JWTAuth::parseToken()->authenticate();
            return response()->json(['status' => 'success', 'token' => $token->get(), 'user' => $user]);
        } catch (TokenExpiredException $e) {
            $newToken = \JWTAuth::refresh($token);
            $user = \JWTAuth::parseToken()->authenticate();

            return response()->json(['status' => 'success', 'token' => $newToken->get(), 'user' => $user]);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error'], 401);
        }
    }
}
