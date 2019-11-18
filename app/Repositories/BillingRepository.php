<?php

namespace App\Repositories;

use App\Billing;
use Illuminate\Database\Eloquent\Collection;

class BillingRepository
{
    /** @var Billing */
    private $billing;

    /**
     * BillingRepository constructor.
     * @param Billing $billing
     */
    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * @param Billing $billing
     * @param int $number
     * @return Collection
     */
    public function getBillingData(Billing $billing, $number): Collection
    {
        return $billing->billingData()->limit($number)->get();
    }

    /**
     * @return int
     */
    public function countAll(): int
    {
        return $this->billing->get()->count();
    }
}
