<?php

namespace Tests\Feature;

use App\Events\UpdatingBilling;
use App\Listeners\ResetBillingSettlement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Billing;
use Tests\TestCase;

class ResetBillingSettlementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_resets_billing_settlement_if_rates_were_changed(): void
    {
        $billing = factory(Billing::class)->create();
        $attributes = [
            'working_days_rate' => $this->faker->randomFloat(4, 0, 1),
            'weekend_rate' => $this->faker->randomFloat(4, 0, 1),
        ];
        $updatingBilling = new UpdatingBilling($billing, $attributes);

        $resetBillingSettlement = new ResetBillingSettlement();
        $resetBillingSettlement->handle($updatingBilling);
        $this->assertNull($billing->settlement);
    }

    /** @test */
    public function it_does_not_reset_billing_settlement_if_rates_have_not_changed(): void
    {
        $randomSettlement = $this->faker->randomFloat(2, 0, 100);
        $billing = factory(Billing::class)->create([
            'settlement' => $randomSettlement
        ]);
        $attributes = [
            'name' => $this->faker->sentence(4),
            'working_days_rate' => $billing->working_days_rate,
            'weekend_rate' => $billing->weekend_rate,
        ];
        $updatingBilling = new UpdatingBilling($billing, $attributes);
        $resetBillingSettlement = new ResetBillingSettlement();
        $resetBillingSettlement->handle($updatingBilling);

        $this->assertEquals($randomSettlement, $billing->settlement);
    }
}
