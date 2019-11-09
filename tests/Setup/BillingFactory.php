<?php

namespace Tests\Setup;

use App\Billing;

class BillingFactory
{
    /**
     * @return Billing
     */
    public function create(): Billing
    {
        return factory(Billing::class)->create();
    }
}
