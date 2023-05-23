<?php

namespace App\Policies;

use App\Models\Form;
use App\Models\User;
use DateTime;
use Illuminate\Auth\Access\Response;

class FormPolicy
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
    public function view(User $user, Form $form): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Form $form): bool
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Form $form): bool
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Form $form): bool
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Form $form): bool
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determines if form can have responses base on is_active and exp_date
     */
    public function submitResponse(User $user, Form $form): Response
    {
        $now = new DateTime();
        $exp = new DateTime($form->exp_date);

        return $form->is_active && $exp >= $now
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
