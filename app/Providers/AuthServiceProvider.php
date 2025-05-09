<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Artist;
use App\Policies\ArtistPolicy;
use App\Models\Movie;
use App\Policies\MoviePolicy;
use App\Models\Cinema;
use App\Policies\CinemaPolicy;
use App\Models\Room;
use App\Policies\RoomPolicy;
use App\Models\Showtime;
use App\Policies\ShowtimePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Artist::class => ArtistPolicy::class,
        Movie::class => MoviePolicy::class,
        Cinema::class => CinemaPolicy::class,
        Room::class => RoomPolicy::class,
        Showtime::class => ShowtimePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
} 