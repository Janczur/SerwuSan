<?php


namespace App\Repositories;


use App\Billing;
use Illuminate\Database\Eloquent\Collection;

class BillingRepository
{
    /**
     * @param $billing
     * @return Collection
     */
    public function saveBillingData($billing): Collection
    {
        /** @var  Billing $billing */
        $rawData = $billing->getRawData();
        return $billing->billingData()->createMany($rawData);
    }
}
