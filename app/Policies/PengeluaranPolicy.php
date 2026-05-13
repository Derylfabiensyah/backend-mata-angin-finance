<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pengeluaran;
use Illuminate\Auth\Access\Response;

class PengeluaranPolicy
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
    public function view(User $user, Pengeluaran $pengeluaran): bool
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
    public function update(User $user, Pengeluaran $pengeluaran): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pengeluaran $pengeluaran): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pengeluaran $pengeluaran): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pengeluaran $pengeluaran): bool
    {
        return false;
    }
}
