<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function registerUser($request)
    {
        $otp = rand(100000, 999999);

        $data = [
            'username'       => $request->username,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'referral'       => $request->referral,
            'heard_about_us' => $request->heard_about_us,
            'country'        => $request->country,
            'email'          => trim($request->email),
            'password'       => bcrypt($request->password),
            'otp_code'       => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ];

        $user = $this->userRepository->create($data);

        if ($user) {
            // // send OTP email
            // Mail::raw("Your OTP code is: {$otp}", function ($message) use ($user) {
            //     $message->to($user->email)
            //         ->subject('Verify your email');
            // });

            return ['error' => false, 'data' => ['email' => $user->email], 'message' => 'Registration successful. Please verify OTP sent to your email.'];
        }

        return ['error' => true, 'message' => 'Registration failed. Please try again.'];
    }

    public function loginUser($request)
    {
        $email = trim($request->email);
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();
            $token = $user->createToken('app-token')->accessToken;
            return [
                'error'   => false,
                'data'    => [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'token' => $token,
                ],
                'message' => 'User login successfully.'
            ];
        }

        return [
            'error'   => true,
            'message' => 'Invalid Email/Password'
        ];
    }
}
