<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Services\UserService;
use App\Traits\ApiResponse;

class UserController extends BaseController
{
    use ApiResponse;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->userService->registerUser($request);

            if ($result['error']) {
                return $this->sendError($result['message']);
            } else {
                return $this->sendResponse($result['data'], $result['message']);
            }
        } catch (\Exception $e) {
            // log error message
            logger($e->getMessage());
            return $this->sendError('Oops! Something went wrong ' . $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->userService->loginUser($request);

            if ($result['error']) {
                return $this->sendError($result['message']);
            } else {
                return $this->sendResponse($result['data'], $result['message']);
            }
        } catch (\Exception $e) {
            // log error message
            logger($e->getMessage());
            return $this->sendError('Oops! Something went wrong ' . $e->getMessage());
        }
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $result = $this->userService->verifyOtp($request);

            if ($result['error']) {
                return $this->sendError($result['message']);
            } else {
                return $this->sendResponse($result['data'], $result['message']);
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->sendError('Oops! Something went wrong ' . $e->getMessage());
        }
    }
}
