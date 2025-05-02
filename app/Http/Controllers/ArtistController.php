<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\Ajax;
use App\Models\Artist;
use App\Models\Country;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Artist::all());
        return view('artists.index', ['artists' => Artist::paginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Artist $artist)
    {
        return view('artists.create', ['artist' => $artist, 'countries' => Country::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtistRequest $request, Artist $artist)
    {
        $validated = $request->validated();

        $artist = Artist::create($validated);

        if ($request->hasFile('acteur-photo')) {
            $photoActeur = $request->file('acteur-photo');
            $filename = 'acteur_' . $artist->id . '.' . $photoActeur->guessClientExtension();
            Image::read($photoActeur)->cover(180, 240)
                ->save(storage_path('/app/public/actors/' . $filename));

            $artist->actor_path = 'actors/' . $filename;
            $artist->save();
        }

        return redirect()->route('artist.index')
            ->with('ok', __('Artist has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        // Load movies that this artist has directed
        $directedMovies = $artist->hasDirected;

        // Load movies where this artist has played in
        $actedInMovies = $artist->hasPlayed;

        return view('artists.show', [
            'artist' => $artist,
            'directedMovies' => $directedMovies,
            'actedInMovies' => $actedInMovies
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', ['artist' => $artist, 'countries' => Country::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArtistRequest $request, Artist $artist)
    {
        $artist->update($request->validated());

        if ($request->hasFile('acteur-photo')) {
            // Delete old photo if exists
            if ($artist->actor_path) {
                Storage::disk('public')->delete($artist->actor_path);
            }

            $photoActeur = $request->file('acteur-photo');
            $filename = 'acteur_' . $artist->id . '.' . $photoActeur->guessClientExtension();
            Image::read($photoActeur)->cover(180, 240)
                ->save(storage_path('/app/public/actors/' . $filename));

            $artist->actor_path = 'actors/' . $filename;
            $artist->save();
        }

        return redirect()->route('artist.index')
            ->with('ok', __('Artist has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->hasPlayed()->detach();
        // $artist->hasDirected()->dissociate();
        $artist->save();
        $artist->delete();

        return response()->json();
    }

    public function __construct()
    {
        // $this->middleware('ajax')->only('destroy');
    }
}
