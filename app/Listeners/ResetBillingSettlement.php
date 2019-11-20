<?php

namespace App\Listeners;

use App\Billing;
use App\Events\UpdatingBilling;

class ResetBillingSettlement
{

    /**
     * Handle the event.
     *
     * @param  UpdatingBilling  $event
     * @return void
     */
    public function handle(UpdatingBilling $event): void
    {
        $update = $this->shouldUpdate($event->billing, $event->attributes);
        if ($update){
            $event->billing->update(['settlement' => null]);
        }
    }

    /**
     * @param Billing $billing
     * @param array $attributes
     * @return bool
     */
    private function shouldUpdate(Billing $billing, array $attributes): bool
    {
        $workingDaysRateChanged = $this->valueHasChanged($billing->working_days_rate, $attributes['working_days_rate']);
        $weekendRateChanged = $this->valueHasChanged($billing->weekend_rate, $attributes['weekend_rate']);

        return $workingDaysRateChanged || $weekendRateChanged;
    }

    /**
     * @param string $oldValue
     * @param string $newValue
     * @return bool
     */
    private function valueHasChanged(string $oldValue, string $newValue): bool
    {
        return $oldValue !== $newValue;
    }
}
