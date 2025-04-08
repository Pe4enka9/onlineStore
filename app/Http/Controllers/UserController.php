<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    // Форма авторизации
    public function authForm(): View
    {
        return view('auth.login');
    }

    // Авторизация
    public function auth(AuthRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return back()->withInput()
                ->withErrors(['auth' => 'Неверный логин или пароль']);
        }

        auth()->login($user);

        return redirect()->route('categories.index');
    }
}
