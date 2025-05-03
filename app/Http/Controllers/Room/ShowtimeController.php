<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Showtime;
use App\Models\Movie;
use App\Http\Requests\StoreShowtimeRequest;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
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
        $movies = Movie::orderBy('title')->get();

        return view('cinemas.rooms.showtimes.create', compact('room', 'movies'));
    }

    /**
     * Store a newly created showtime in storage.
     */
    public function store(StoreShowtimeRequest $request, Room $room)
    {
        $validated = $request->validated();

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
        $showtime->load('room.cinema');
        $movies = Movie::orderBy('title')->get();

        return view('cinemas.rooms.showtimes.edit', compact('showtime', 'movies'));
    }

    /**
     * Update the specified showtime in storage.
     */
    public function update(StoreShowtimeRequest $request, Showtime $showtime)
    {
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
        $roomId = $showtime->room_id;
        $showtime->delete();

        return redirect()->route('room.showtime.index', $roomId)
            ->with('ok', __('Showtime has been deleted'));
    }
}
