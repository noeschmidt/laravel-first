<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
// <!-- Petite info : Ce controller sert à gérer les actions liées aux showtimes en général -->
{
    /**
     * Display a listing of all showtimes across all cinemas/rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $showtimes = Showtime::with(['movie', 'room', 'room.cinema'])
                                ->orderBy('start_time')
                                ->paginate(15); // Pagination parce que trop de résultats

        return view('showtimes.index', compact('showtimes'));
    }
}
