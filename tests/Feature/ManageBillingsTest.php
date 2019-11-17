<?php

namespace Tests\Feature;

use App\Billing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\BillingFactory;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ManageBillingsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_manage_billings(): void
    {
        $billing = BillingFactory::create();

        $this->get(route('billings.index'))->assertRedirect('login');
        $this->get(route('billings.create'))->assertRedirect('login');
        $this->get(route('billings.show', $billing))->assertRedirect('login');
        $this->post(route('billings.store'), $billing->toArray())->assertRedirect('login');
        $this->get(route('billings.edit', $billing))->assertRedirect('login');
        $this->patch(route('billings.update', $billing))->assertRedirect('login');
        $this->post(route('billings.destroy', $billing->toArray()))->assertRedirect('login');
    }


    /** @test */
    public function a_user_can_create_billing(): void
    {
        $this->signIn();
        $this->get(route('billings.create'))->assertStatus(200);
        $file = $this->getTestFile();

        $attributes = [
            'name' => $this->faker->sentence(4),
            'working_days_rate' => $this->faker->randomFloat(4, 0, 1),
            'weekend_rate' => $this->faker->randomFloat(4, 0, 1),
            'import_file' => $file
        ];

        $this->post(route('billings.store'), $attributes)
            ->assertRedirect(route('billings.index'))
            ->assertSessionHas('success');

        unset($attributes['import_file']);
        $this->assertDatabaseHas('billings', $attributes);
    }

    /** @test */
    public function a_billing_requires_a_name(): void
    {
        $this->signIn();
        $attributes = factory(Billing::class)->raw(['name' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_billing_requires_a_working_days_rate(): void
    {
        $this->signIn();
        $attributes = factory(Billing::class)->raw(['working_days_rate' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('working_days_rate');
    }

    /** @test */
    public function a_billing_requires_a_weekend_rate(): void
    {
        $this->signIn();
        $attributes = factory(Billing::class)->raw(['weekend_rate' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('weekend_rate');
    }

    /** @test */
    public function an_authenticated_user_can_view_his_billing(): void
    {
        $billing = BillingFactory::create();

        $this->actingAs($billing->owner)
            ->get(route('billings.show', $billing))
            ->assertSee($billing->name)
            ->assertSee($billing->working_days_rate)
            ->assertSee($billing->weekend_rate);
    }

    /** @test */
    public function an_authenticated_user_can_update_his_billing(): void
    {
        $billing = BillingFactory::create();

        $this->actingAs($billing->owner)
            ->get(route('billings.edit', $billing))
            ->assertSee($billing->name);

        $attributes = [
            'name' => $this->faker->sentence(4),
            'working_days_rate' => $this->faker->randomFloat(4, 0, 1),
            'weekend_rate' => $this->faker->randomFloat(4, 0, 1),
        ];

        $this->actingAs($billing->owner)
            ->patch(route('billings.update', $billing), $attributes)
            ->assertRedirect(route('billings.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('billings', $attributes);
    }


    /** @test */
    public function an_authenticated_user_can_delete_their_billing(): void
    {
        $billing = BillingFactory::create();

        $this->actingAs($billing->owner)
            ->delete(route('billings.destroy', $billing))
            ->assertRedirect(route('billings.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('billings', $billing->only('id'));
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_billings_of_others(): void
    {
        $this->signIn();
        $billing = BillingFactory::create();
        $this->get(route('billings.show', $billing))
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_destroy_the_billings_of_others(): void
    {
        $this->signIn();
        $billing = BillingFactory::create();
        $this->delete(route('billings.destroy', $billing))
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_see_only_his_billings(): void
    {
        $this->signIn();
        $billing = BillingFactory::create();

        $this->get(route('billings.index'))
            ->assertViewMissing($billing->name);
    }

    /** @test */
    public function an_authenticated_user_can_calculate_settlement_of_his_billing(): void
    {
        $billing = BillingFactory::create();

        $this->actingAs($billing->owner)
            ->get(route('billings.index'))
            ->assertSee('Przelicz');

        $attributes = ['billing_id' => $billing->id];
        $response = $this->json('POST', route('billings.calculate.settlement'), $attributes);

        $response->assertJson([
            'calculated' => true
        ]);
    }
}
