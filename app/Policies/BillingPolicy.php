<?php

namespace App\Policies;

use App\Billing;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any billings.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the billing.
     *
     * @param User $user
     * @param Billing $billing
     * @return mixed
     */
    public function view(User $user, Billing $billing)
    {
        return $user->is($billing->owner);
    }

    /**
     * Determine whether the user can create billings.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the billing.
     *
     * @param User $user
     * @param Billing $billing
     * @return mixed
     */
    public function update(User $user, Billing $billing)
    {
        return $user->is($billing->owner);
    }

    /**
     * Determine whether the user can delete the billing.
     *
     * @param User $user
     * @param Billing $billing
     * @return mixed
     */
    public function delete(User $user, Billing $billing)
    {
        return $user->is($billing->owner);
    }

    /**
     * Determine whether the user can restore the billing.
     *
     * @param User $user
     * @param Billing $billing
     * @return mixed
     */
    public function restore(User $user, Billing $billing)
    {
        return $user->is($billing->owner);
    }

    /**
     * Determine whether the user can permanently delete the billing.
     *
     * @param User $user
     * @param Billing $billing
     * @return mixed
     */
    public function forceDelete(User $user, Billing $billing)
    {
        return $user->is($billing->owner);
    }
}
