<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\Ajax;
use App\Models\Artist;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Artist::all());
        return view('artists.index', ['artists' => Artist::paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Artist::class);
        $countries = Country::all();
        return view('artists.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Artist::class);
        $validated = app(ArtistRequest::class)->validated();
        $validated['user_id'] = Auth::id();

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
        $directedMovies = $artist->hasDirected;

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
        $this->authorize('update', $artist);
        $countries = Country::all();
        return view('artists.edit', compact('artist', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $this->authorize('update', $artist);
        $validated = app(ArtistRequest::class)->validated();
        $artist->update($validated);

        if ($request->hasFile('acteur-photo')) {
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
        $this->authorize('delete', $artist);
        $artist->hasPlayed()->detach();
        // $artist->hasDirected()->dissociate();
        $artist->save();
        $artist->delete();

        return response()->json();
    }

    public function __construct()
    {
        // marche pas
        // $this->middleware('ajax')->only('destroy');
    }
}
