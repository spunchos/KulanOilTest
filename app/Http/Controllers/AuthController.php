<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function loginProcess(LoginUserRequest $request)
    {
        if (auth("web")->attempt($request->validated())){
            return redirect(route("user.userApps"));
        }

        return redirect(route("login"))->withErrors(["email" => "Wrong data or user not found"]);
    }

    public function registerForm(): View
    {
        return view('auth.register', [
            'cities' => City::all(),
        ]);
    }

    public function registerProcess(RegisterUserRequest $request): Redirector
    {
        $user = User::create($request->all());

        if ($user)
        {
            auth("web")->login($user);
        }

        return redirect(route("user.userApps"));
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect(route("city.index"));
    }
}
