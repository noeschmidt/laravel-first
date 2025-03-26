<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Http\Middleware\Ajax;
use App\Models\Movie;
use App\Models\Artist;
use App\Models\Country;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.index', ['movies' =>
        Movie::paginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Movie $movie)
    {
        return view('movies.create', ['movie' => $movie, 'directors' => Artist::all(), 'countries' => Country::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        Movie::create($request->validated());

        return redirect()->route('movie.index')
            ->with('ok', __('Movie has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $movie->load('actors');
        $artists = Artist::all();

        return view('movies.show', ['movie' => $movie, 'artists' => $artists]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', ['movie' => $movie, 'directors' => Artist::all(), 'countries' => Country::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return redirect()->route('movie.index')
            ->with('ok', __('Movie has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json();
    }

    public function attach(Request $request, Movie $movie)
    {
        // attache l'artiste au film
        $movie->actors()->attach($request->get('actor_id'), ['role_name' => $request->get('role')]);

        return redirect()->route('movie.show', $movie)
            ->with('ok', __('Actor has been attached to movie'));
    }
}
