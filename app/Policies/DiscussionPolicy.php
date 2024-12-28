<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiscussionPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true;
    }

    public function reply (User $user, Discussion $discussion) {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Discussion $discussion): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Discussion $discussion): bool
    {
        //
        return $user->id == $discussion->user_id;
    }

    public function solve(User $user, Discussion $discussion): bool
    {
        //
        return $user->id == $discussion->user_id;
    }

}
