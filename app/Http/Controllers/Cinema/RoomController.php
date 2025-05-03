<?php

namespace App\Http\Controllers\Cinema;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms for a specific cinema.
     */
    public function index(Cinema $cinema)
    {
        $rooms = $cinema->rooms()->orderBy('name')->get();

        return view('cinemas.rooms.index', compact('cinema', 'rooms'));
    }

    /**
     * Show the form for creating a new room for a specific cinema.
     */
    public function create(Cinema $cinema)
    {
        return view('cinemas.rooms.create', compact('cinema'));
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(StoreRoomRequest $request, Cinema $cinema)
    {
        $validated = $request->validated();

        $cinema->rooms()->create($validated);

        return redirect()->route('cinema.room.index', $cinema->id)
            ->with('ok', __('Room has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return redirect()->route('cinema.room.index', $room->cinema_id);
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        return view('cinemas.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(StoreRoomRequest $request, Room $room)
    { 
        $validated = $request->validated();
        $room->update($validated);

        return redirect()->route('cinema.room.index', $room->cinema_id)
            ->with('ok', __('Room has been updated'));
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        $cinemaId = $room->cinema_id;
        $room->delete();

        return redirect()->route('cinema.room.index', $cinemaId)
            ->with('ok', __('Room has been deleted'));
    }
}
