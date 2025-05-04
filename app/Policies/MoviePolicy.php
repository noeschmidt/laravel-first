<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoviePolicy
{
    /**
     * Determine whether the user can view any models.
     * Allow anyone (including guests) to view the list.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can see the list of movies
    }

    /**
     * Determine whether the user can view the model.
     * Allow anyone (including guests) to view a specific movie.
     */
    public function view(?User $user, Movie $movie): bool
    {
        return true; // Anyone can see a specific movie details
    }

    /**
     * Determine whether the user can create models.
     * Only authenticated users can create movies.
     */
    public function create(User $user): bool
    {
        return $user !== null; // Or simply true if middleware already handles authentication
    }

    /**
     * Determine whether the user can update the model.
     * Only the user who created the movie can update it.
     */
    public function update(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     * Only the user who created the movie can delete it.
     */
    public function delete(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * Only the user who created the movie can restore it (if using SoftDeletes).
     */
    public function restore(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     * Only the user who created the movie can force delete it.
     */
    public function forceDelete(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }
}
