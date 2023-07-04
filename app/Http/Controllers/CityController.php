<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $cities = City::query()->orderBy('created_at', 'DESC')->paginate(10);

        return view("city.index", [
            "cities" => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCityRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCityRequest $request): RedirectResponse
    {
        City::create($request->validated());

        return redirect(route("city.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return View
     */
    public function edit(City $city): View
    {
        return view("city.create", [
            "city" => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCityRequest $request
     * @param City $city
     * @return RedirectResponse
     */
    public function update(UpdateCityRequest $request, City $city): RedirectResponse
    {
        $data = $request->validated();
        $city->update($data);

        return redirect(route("city.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return RedirectResponse
     */
    public function destroy(City $city): RedirectResponse
    {
        $city->delete();

        return redirect(route('city.index'));
    }
}
