<?php

namespace Tests\Unit;

use App\Billing;
use App\BillingData;
use App\User;
use Facades\Tests\Setup\BillingFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BillingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_billing_belongs_to_an_owner(): void
    {
        $billing = BillingFactory::create();
        $this->assertInstanceOf(User::class, $billing->owner);
    }

    /** @test */
    public function settlement_is_calculated_correctly(): void
    {
        $billing = factory(Billing::class)->create([
            'working_days_rate' => 0.0191,
            'weekend_rate' => 0.018
        ]);
        $billingData = new Collection([
            factory(BillingData::class)->make(['call_start_date' => '2019-11-12 08:00:00', 'call_duration' => 231445]), //wtorek
            factory(BillingData::class)->make(['call_start_date' => '2019-10-17 18:00:01', 'call_duration' => 942352]), //czwartek
            factory(BillingData::class)->make(['call_start_date' => '2019-10-26 14:40:49', 'call_duration' => 684132]), //sobota
            factory(BillingData::class)->make(['call_start_date' => '2019-11-11 13:12:11', 'call_duration' => 114423]), //poniedzialek
            factory(BillingData::class)->make(['call_start_date' => '2019-09-01 07:59:59', 'call_duration' => 953453]), //niedziela
            factory(BillingData::class)->make(['call_start_date' => '2019-11-03 18:00:00', 'call_duration' => 745633]), //niedziela
            factory(BillingData::class)->make(['call_start_date' => '2019-11-08 15:00:20', 'call_duration' => 563054]), //piątek
            factory(BillingData::class)->make(['call_start_date' => '2019-11-05 08:00:00', 'call_duration' => 423210]), //środa
        ]);
        $billing->billingData()->saveMany($billingData);
        $settlement = $billing->calculatesettlement();

        $this->assertEquals(852.99, $settlement);
    }
}
