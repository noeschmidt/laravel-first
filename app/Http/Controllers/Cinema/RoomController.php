<?php

namespace App\Http\Controllers\Cinema;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
// <!-- Petite info : Ce controller sert à gérer les actions liées aux rooms et spécifiquement dans le contexte d'un cinéma -->
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
     * Display a listing of all rooms across all cinemas.
     *
     * @return \Illuminate\View\View
     */
    public function globalIndex()
    {
        $rooms = Room::with('cinema')
                     ->orderBy('updated_at', 'desc')
                     ->orderBy('name')
                     ->paginate(15);

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room for a specific cinema.
     */
    public function create(Cinema $cinema)
    {
        $this->authorize('update', $cinema);
        return view('cinemas.rooms.create', compact('cinema'));
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(StoreRoomRequest $request, Cinema $cinema)
    {
        $this->authorize('update', $cinema);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

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
        $this->authorize('update', $room);
        return view('cinemas.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(StoreRoomRequest $request, Room $room)
    {
        $this->authorize('update', $room);
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
        $this->authorize('delete', $room);
        $cinemaId = $room->cinema_id;
        $room->delete();

        return redirect()->route('cinema.room.index', $cinemaId)
            ->with('ok', __('Room has been deleted'));
    }
}
