<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Spot;
use App\Models\User;

class SpotPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Spot $spot): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Spot $spot): bool
    {
        // user_id が投稿者のidと同じであればupdateを許可する
        return $user->id == $spot->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Spot $spot): bool
    {
        // 投稿作成者には削除を許可する
        if ($user->id == $spot->user_id) {
            return true;
        }

        // 管理者には削除を許可する
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Spot $spot): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Spot $spot): bool
    {
        return false;
    }
}
