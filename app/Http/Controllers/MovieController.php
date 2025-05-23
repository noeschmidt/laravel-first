<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\MovieRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
        Movie::orderBy('updated_at', 'desc')->paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Movie::class);
        $directors = Artist::all();
        $countries = Country::all();
        return view('movies.create', compact('directors', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request, Movie $movie)
    {
        $this->authorize('create', Movie::class);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $movie = Movie::create($validated);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $filename = 'poster_' . $movie->id . '.' . $poster->guessClientExtension();
            Image::read($poster)->cover(180, 240)
                ->save(storage_path('/app/public/posters/' . $filename));

            $movie->poster_path = 'posters/' . $filename;
            $movie->save();
        }

        return redirect()->route('movie.index')
            ->with('ok', __('Movie has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        // On vient charger les acteurs du film
        $movie->load('actors');

        // Récup. les IDs des acteurs déjà liés au film
        // Pluck "retrieves all of the values for a given key)
        // Et ici la given key c'est l'id du coup
        $existingActorIds = $movie->actors->pluck('id')->toArray();

        // Récupérer les artistes qui ne sont pas déjà associés au film
        $availableArtists = Artist::whereNotIn('id', $existingActorIds)->get();
        $artists = Artist::all();

        return view('movies.show', ['movie' => $movie, 'artists' => $artists, 'availableArtists' => $availableArtists]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $directors = Artist::all();
        $countries = Country::all();
        return view('movies.edit', compact('movie', 'directors', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $movie->update($request->validated());

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($movie->poster_path) {
                Storage::disk('public')->delete($movie->poster_path);
            }

            $poster = $request->file('poster');
            $filename = 'poster_' . $movie->id . '.' . $poster->guessClientExtension();
            Image::read($poster)->cover(180, 240)
                ->save(storage_path('/app/public/posters/' . $filename));

            $movie->poster_path = 'posters/' . $filename;
            $movie->save();
        }

        return redirect()->route('movie.index')
            ->with('ok', __('Movie has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();

        if ($movie->poster_path) {
            Storage::delete('public/posters/' . basename($movie->poster_path));
        }

        return redirect()->route('movie.index')
            ->with('ok', __('Movie has been deleted'));
    }

    // A améliorer pour la prod utiliser MovieRequest
    public function attach(Request $request, Movie $movie)
    {
        // attache l'artiste au film
        $movie->actors()->attach($request->get('actor_id'), ['role_name' => $request->get('role')]);

        return redirect()->route('movie.show', $movie)
            ->with('ok', __('Actor has been attached to movie'));
    }

    public function detach(Request $request, Movie $movie, Artist $artist)
    {
        $movie->actors()->detach($artist);

        return response()->json();
        // return redirect()->route('movie.show', $movie)
        //     ->with('ok', __('Actor has been detached from movie'));
    }
}
