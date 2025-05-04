<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CinemaRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Cinema;
use Illuminate\Support\Facades\Auth;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cinema.index', ['cinemas' => Cinema::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Cinema::class);
        return view('cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CinemaRequest $request)
    {
        $this->authorize('create', Cinema::class);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $cinema = Cinema::create($validated);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $filename = 'poster_' . $cinema->id . '.' . $poster->guessClientExtension();
            Image::read($poster)->cover(180, 240)
                ->save(storage_path('/app/public/posters/' . $filename));

            $cinema->poster_path = 'posters/' . $filename;
            $cinema->save();
        }

        return redirect()->route('cinema.index')
            ->with('ok', __('Cinema has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema)
    {
        return view('cinema.show', ['cinema' => $cinema]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cinema $cinema)
    {
        $this->authorize('update', $cinema);
        return view('cinema.edit', ['cinema' => $cinema]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CinemaRequest $request, Cinema $cinema)
    {
        $this->authorize('update', $cinema);
        $cinema->update($request->validated());

        if ($request->hasFile('poster')) {
            // Supprimer ancien poster s'il existe
            if ($cinema->poster_path) {
                Storage::disk('public')->delete($cinema->poster_path);
            }

            $poster = $request->file('poster');
            $filename = 'poster_' . $cinema->id . '.' . $poster->guessClientExtension();
            Image::read($poster)->cover(180, 240)
                ->save(storage_path('/app/public/posters/' . $filename));

            $cinema->poster_path = 'posters/' . $filename;
            $cinema->save();
        }

        return redirect()->route('cinema.index')
            ->with('ok', __('Cinema has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema)
    {
        $this->authorize('delete', $cinema);
        $cinema->delete();

        return redirect()->route('cinema.index')
            ->with('ok', __('Cinema has been deleted'));
    }
}
