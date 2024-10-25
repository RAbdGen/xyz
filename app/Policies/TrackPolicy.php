<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Track;
use App\Services\UserService;

class TrackPolicy
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
    public function view(User $user, Track $track): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return app(UserService::class)->remainingTracksCount() > 0;
    }
}
