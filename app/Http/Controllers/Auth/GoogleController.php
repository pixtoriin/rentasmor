<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Solo permitimos acceso si el correo ya está registrado en nuestra BD
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/vistaDashboard'); // o donde quieras llevarlo
            } else {
                return redirect('/')->with('error', 'Tu cuenta no está autorizada.');
            }

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}