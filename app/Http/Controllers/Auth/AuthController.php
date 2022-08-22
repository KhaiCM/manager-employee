<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendPasswordResetMailRequest;
use App\Services\AuthService;
use App\Services\MailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $authService;
    protected $mailService;

    /**
     * Create a new AuthController instance.
     *
     * AuthService $authService
     * @return void
     */
    public function __construct(
        AuthService $authService,
        MailService $mailService
    ) {
        $this->authService = $authService;
        $this->mailService = $mailService;
    }

    /**
     * Register a User.
     *
     * RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->createUser($request);

        if ($user) {
            return defineResponse(
                __('messages.register-success'),
                $user
            );
        }

        return defineResponse(
            __('messages.register-fail'),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $token = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$token) {
            return defineResponse(
                __('messages.login-fail'),
                Response::HTTP_BAD_REQUEST
            );
        }

        return defineResponse(
            __('messages.login-success'),
            $this->createNewToken($token)
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return defineResponse(
            __('messages.logout-success')
        );
    }

    /**
     * Send password reset email
     *
     * @return JsonResponse
     */
    public function sendPasswordResetEmail(SendPasswordResetMailRequest $request)
    {
        $isOtherToken = $this->authService->getDataWithEmail($request->email);

        if (!$isOtherToken) {
            $token = Str::random(80);
            $result = $this->authService->saveToken($request->email, $token);
        } else {
            $token = $isOtherToken->token;
            $result = true;
        }

        if ($result) {
            $this->mailService->sendPasswordResetMail($request->email, $token);
            
            return defineResponse(
                __('messages.send-password-reset-mail')
            );
        } else {
            return defineResponse(
                __('messages.wrong'),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Reset password
     *
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $result = $this->authService->getDataWithEmailAndToken($request->email, $request->token);
        if ($result) {
            $this->authService->updatePassword($request->email, $request->password);

            return defineResponse(
                __('messages.password-updated')
            );
        }

        return defineResponse(
            __('messages.reset-password-fail'),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Get the token array structure.
     *
     * string $token
     *
     * @return JsonResponse
     */
    public function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(), // 60 minutes
            'user' => auth()->user(),
        ];
    }
}
