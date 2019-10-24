<?php

namespace Tests\Feature;

use App\Billing;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageBillingsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_manage_billings()
    {
        $billing = factory(Billing::class)->create();

        $this->get(route('billings.index'))->assertRedirect('login');
        $this->get(route('billings.create'))->assertRedirect('login');
        $this->get(route('billings.show', $billing))->assertRedirect('login');
        $this->post(route('billings.store'), $billing->toArray())->assertRedirect('login');
        $this->post(route('billings.destroy', $billing->toArray()))->assertRedirect('login');
    }


    /** @test */
    public function a_user_can_create_billing()
    {
        $this->actingAs(factory(User::class)->create());

        $this->get(route('billings.create'))->assertStatus(200);
        $attributes = [
            'name' => $this->faker->sentence(4),
            'working_days_rate' => $this->faker->randomFloat(4, 0, 1),
            'saturday_rate' => $this->faker->randomFloat(4, 0, 1),
        ];

        $this->post(route('billings.store'), $attributes)
            ->assertRedirect(route('billings.index'))
            ->assertSessionHas('success');
        $this->assertDatabaseHas('billings', $attributes);
        $this->get(route('billings.index'))->assertSee($attributes['name']);
    }

    /** @test */
    public function a_billing_requires_a_name()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Billing::class)->raw(['name' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_billing_requires_a_working_days_rate()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Billing::class)->raw(['working_days_rate' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('working_days_rate');
    }

    /** @test */
    public function a_billing_requires_a_saturday_rate()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Billing::class)->raw(['saturday_rate' => '']);

        $this->post(route('billings.store'), $attributes)
            ->assertSessionHasErrors('saturday_rate');
    }

    /** @test */
    public function a_user_can_view_their_billing()
    {
        $billing = factory(Billing::class)->create();

        $this->actingAs($billing->owner)
            ->get(route('billings.show', $billing))
            ->assertSee($billing->name)
            ->assertSee($billing->working_days_rate)
            ->assertSee($billing->saturday_rate);
    }

    /** @test */
    public function a_user_can_delete_their_billing()
    {
        $billing = factory(Billing::class)->create();

        $this->actingAs($billing->owner)
            ->delete(route('billings.destroy', $billing))
            ->assertRedirect(route('billings.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('billings', $billing->only('id'));
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_billings_of_others()
    {
        $this->be(factory(User::class)->create());
        $billing = factory(Billing::class)->create();
        $this->get(route('billings.show', $billing))
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_destroy_the_billings_of_others()
    {
        $this->be(factory(User::class)->create());
        $billing = factory(Billing::class)->create();
        $this->delete(route('billings.destroy', $billing))
            ->assertStatus(403);
    }
}
