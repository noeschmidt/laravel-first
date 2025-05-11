<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Showtime;
use App\Models\Movie;
use App\Http\Requests\StoreShowtimeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowtimeController extends Controller
// <!-- Petite info : Ce controller sert à gérer les actions liées aux showtime et spécifiquement dans le contexte d'une room -->
{
    /**
     * Display a listing of the showtimes for a specific room.
     */
    public function index(Room $room)
    {
        $showtimes = $room->showtimes()->with('movie')->orderBy('start_time')->get();

        return view('cinemas.rooms.showtimes.index', compact('room', 'showtimes'));
    }

    /**
     * Show the form for creating a new showtime for a specific room.
     */
    public function create(Room $room)
    {
        $this->authorize('create', Showtime::class);
        $movies = Movie::all();
        return view('cinemas.rooms.showtimes.create', compact('room', 'movies'));
    }

    /**
     * Store a newly created showtime in storage.
     */
    public function store(StoreShowtimeRequest $request, Room $room)
    {
        $this->authorize('create', Showtime::class);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $room->showtimes()->create($validated);

        return redirect()->route('room.showtime.index', $room->id)
            ->with('ok', __('Showtime has been saved'));
    }

    /**
     * Display the specified showtime (not typically used).
     */
    public function show(Showtime $showtime)
    {
        return redirect()->route('room.showtime.index', $showtime->room_id);
    }

    /**
     * Show the form for editing the specified showtime.
     */
    public function edit(Showtime $showtime)
    {
        $this->authorize('update', $showtime);
        $showtime->load('room.cinema');
        $movies = Movie::all();

        return view('cinemas.rooms.showtimes.edit', compact('showtime', 'movies'));
    }

    /**
     * Update the specified showtime in storage.
     */
    public function update(StoreShowtimeRequest $request, Showtime $showtime)
    {
        $this->authorize('update', $showtime);
        $validated = $request->validated();
        $showtime->update($validated);

        return redirect()->route('room.showtime.index', $showtime->room_id)
            ->with('ok', __('Showtime has been updated'));
    }

    /**
     * Remove the specified showtime from storage.
     */
    public function destroy(Showtime $showtime)
    {
        $this->authorize('delete', $showtime);
        $roomId = $showtime->room_id;
        $showtime->delete();

        return redirect()->route('room.showtime.index', $roomId)
            ->with('ok', __('Showtime has been deleted'));
    }
}
