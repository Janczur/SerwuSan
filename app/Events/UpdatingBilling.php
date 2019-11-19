<?php

namespace App\Events;

use App\Billing;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatingBilling
{
    use Dispatchable,  SerializesModels;

    /** @var Billing */
    public $billing;

    /** @var array */
    public $attributes;

    /**
     * Create a new event instance.
     *
     * @param Billing $billing
     * @param array $attributes
     */
    public function __construct(Billing $billing, array $attributes)
    {
        $this->billing = $billing;
        $this->attributes = $attributes;
    }
}
