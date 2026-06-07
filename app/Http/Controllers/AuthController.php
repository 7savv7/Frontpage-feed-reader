<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signIn()
    {
        return view("sign-in");
    }

    public function signUp()
    {
        return view("sign-up");
    }

    public function logIn(Request $request)
    {
        $credentials = $request->validate(
            [
                "email" => ["required", "email"],
                "password" => ["required"]
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect("/");
        }


        return back()->withErrors([
            "email" => "Wrong credentials"
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                "email" => ["required", "email", "unique:users,email"],
                "password" => ["required", "min:6", "confirmed"]
            ]
        );

        try {
            $user = User::create(
                [
                    "email" => $validated["email"],
                    "password" => Hash::make($validated["password"])
                ]
            );
        } catch (\Exception $e) {
            return back()->withErrors(
                ["error" => "Something wrong happened while creating account."]
            );
        }

        Auth::login($user);

        return redirect("/");
    }

    public function signOut()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/sign-up");
    }
}
