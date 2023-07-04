<?php

namespace App\Http\Controllers;

use App\Actions\CheckApplicationsForJoinAction;
use App\Actions\JoinApplicationsAction;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\JoinApplicationRequest;
use App\Models\Application;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Application::class, 'application');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $applications = Application::query()->orderBy('created_at', 'DESC')->paginate(10);

        return view("application.index", [
            "applications" => $applications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('application.create', [
            'cities' => City::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplicationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreApplicationRequest $request): RedirectResponse
    {
        auth()->user()->applications()->create($request->validated());

        return redirect(route('user.userApps'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Application $application
     * @return RedirectResponse
     */
    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return redirect(route('application.index'));
    }

    /**
     * Decline the specified resource from storage.
     *
     * @param Application $application
     * @return RedirectResponse
     */
    public function decline(Application $application): RedirectResponse
    {
        $application->status = 'declined';
        $application->save();

        return redirect(route('application.index'));
    }

    /**
     * Show the form for join resources.
     *
     * @return View
     */
    public function joinForm(): View
    {
        return view('application.join', [
            'applications' => Application::all(),
        ]);
    }

    /**
     * Join the specified resources if possible.
     *
     * @param JoinApplicationRequest $request
     * @return RedirectResponse
     */
    public function joinProcess(
        JoinApplicationRequest $request,
        CheckApplicationsForJoinAction $checkApplicationsForJoinAction,
        JoinApplicationsAction $joinApplicationsAction
    ): RedirectResponse
    {
        $IDs = $request->validated()['applications'];
        $apps = Application::query()->whereIn('id', $IDs)->get();

        if (!$checkApplicationsForJoinAction->handle($apps))
        {
            return redirect(route('application.joinForm'))->withErrors(['applications' => 'Applications have different cities or dates']);
        }

        $joinApplicationsAction->handle($apps);

        return redirect(route('application.index'));
    }
}
