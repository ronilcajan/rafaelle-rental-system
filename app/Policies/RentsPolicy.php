<?php

namespace App\Policies;

use App\Models\Rents;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RentsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny_rents(User $user): bool
    {
        return $user->hasRole('rental-admin|rental-manager');

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rents $rents): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create_rents(User $user): bool
    {
        return $user->hasRole('rental-admin|rental-manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rents $rents): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rents $rents): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rents $rents): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rents $rents): bool
    {
        //
    }
}