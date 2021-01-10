<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Страница авторизации
     *
     * @return \Illuminate\View\View
     */
    public function auth()
    {
        return view('auth');
    }

    /**
     * Страница регистрации
     *
     * @return \Illuminate\View\View
     */
    public function registrationView()
    {
        return view('registration');
    }

    /**
     * Авторизация
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('login', 'password');

        $user = User::where('login', $request->input('login'))
            ->where('password', $request->input('password'))
            ->first();

        if (is_null($user)) {
            return response()->json([
                'error'=> 'Неверный логин или пароль',
                'status' => false
            ]);
        }

        $token = auth()->login($user);

        return response()->json([
            'user'=> $user,
            'status' => true
        ])->withCookie(cookie('token', $token, 1000));
    }

    /**
     * Регистрация
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(RegistrationRequest $request)
    {
        $user = User::create([
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        $token = auth()->login($user);

        return response()->json([
            'user'=> $user,
            'status' => true
        ])->withCookie(cookie('token', $token, 1000));
    }
}
