<?php

namespace App\Policies;

use App\Exceptions\InactiveBranchException;
use App\Models\Branch;
use App\Models\User;

class BranchPolicy
{
    /**
     * Assert that the given branch is active, throwing InactiveBranchException
     * if it is not. Use this before any Member or transaction assignment.
     *
     * @throws InactiveBranchException
     */
    public static function assertActive(Branch $branch): void
    {
        if ($branch->is_active === false) {
            throw new InactiveBranchException();
        }
    }

    /**
     * Determine whether the user can view any branches.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the branch.
     */
    public function view(User $user, Branch $branch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create branches.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the branch.
     */
    public function update(User $user, Branch $branch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the branch.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can assign to the branch.
     * Returns false (and is used alongside assertActive) for inactive branches.
     */
    public function assign(User $user, Branch $branch): bool
    {
        return $branch->is_active === true;
    }
}
