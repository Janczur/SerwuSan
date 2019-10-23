<?php

namespace Tests\Unit;

use App\Billing;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BillingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_billing_belongs_to_an_owner()
    {
        $billing = factory(Billing::class)->create();
        $this->assertInstanceOf(User::class, $billing->owner);
    }
}
