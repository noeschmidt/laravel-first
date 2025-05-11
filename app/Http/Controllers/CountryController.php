<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use App\Http\Middleware\Ajax;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('countries.index', ['countries' =>
        Country::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Country::class);
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $this->authorize('create', Country::class);
        Country::create($request->validated());

        return redirect()->route('country.index')
            ->with('ok', __('Country has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $this->authorize('update', $country);
        return view('countries.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $this->authorize('update', $country);
        $country->update($request->validated());

        return redirect()->route('country.index')
            ->with('ok', __('Country has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $this->authorize('delete', $country);
        // soit supprimer d'abord l'artiste et après le country
        // ou alors automatiquement faire que ça delete
        $country->artists()->delete();
        $country->save();

        $country->delete();

        return response()->json();
    }
}
