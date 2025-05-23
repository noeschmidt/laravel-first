<?php

namespace App\Policies;

use App\Models\Showtime;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShowtimePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Showtime $showtime): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Showtime $showtime): bool
    {
        return $user->id === $showtime->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Showtime $showtime): bool
    {
        return $user->id === $showtime->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Showtime $showtime): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Showtime $showtime): bool
    {
        return false;
    }
}
