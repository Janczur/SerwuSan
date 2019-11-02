<?php


namespace Tests\Setup;


use App\Billing;

class BillingFactory
{
    public function create()
    {
        $billing = factory(Billing::class)->create();

        return $billing;
    }
}
