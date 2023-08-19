<?php

namespace App\Policies;

use App\Models\Friend_ship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FriendShipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Friend_ship  $friendShip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Friend_ship $friendShip)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Friend_ship  $friendShip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Friend_ship $friendShip)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Friend_ship  $friendShip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Friend_ship $friendShip)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Friend_ship  $friendShip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Friend_ship $friendShip)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Friend_ship  $friendShip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Friend_ship $friendShip)
    {
        //
    }
}
