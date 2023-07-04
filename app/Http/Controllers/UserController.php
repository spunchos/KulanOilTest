<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view("user.index", [
            "users" => User::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function makeAdmin(User $user): RedirectResponse
    {
        $user->role = 'admin';
        $user->save();

        return redirect(route('user.index'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function userApps(): View
    {
        return view("user.usersApps", [
            "applications" => Application::query()
                ->where('user_id', '=', auth()->user()->getAuthIdentifier())
                ->get(),
        ]);
    }
}
