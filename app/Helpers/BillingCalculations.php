<?php

namespace App\Helpers;

use App\Billing;
use Carbon\Carbon;

class BillingCalculations
{
    /** @var string the time from which we start charging money */
    private const FROM_TIME = '08:00:00';

    /** @var string the time from which we stop charging money */
    private const TO_TIME = '18:00:00';

    /** @var float fee for one minute of conversation on business days */
    private const WORKING_DAYS_RATE = 0.0191;

    /** @var float fee for one minute of conversation during the weekend */
    private const WEEKEND_RATE = 0.018;

    /**
     * @param Billing $billing
     * @return float
     */
    public function calculateSettlement(Billing $billing): float
    {
        $totalWorkingDaysCallDuration = 0;
        $totalWeekendCallDuration = 0;

        foreach($billing->billingData as $data){

            $callStartDate = Carbon::create($data->call_start_date);
            $callStartTime = $callStartDate->format('H:i:s');

            if ($this->shouldCalculate($callStartTime)){
                $callStartDate->isWeekday() ? $totalWorkingDaysCallDuration += $data->call_duration : $totalWeekendCallDuration += $data->call_duration;
            }
        }
        $totalWorkingDaysMinutes = $totalWorkingDaysCallDuration / 60;
        $totalWeekendMinutes = $totalWeekendCallDuration / 60;

        $workingDaysPayment = $totalWorkingDaysMinutes * self::WORKING_DAYS_RATE;
        $weekendPayment = $totalWeekendMinutes * self::WEEKEND_RATE;

        $totalPayment = $workingDaysPayment + $weekendPayment;

        return round($totalPayment, 2);
    }

    /**
     * @param string $callStartTime
     * @return bool
     */
    private function shouldCalculate(string $callStartTime): bool
    {
        return $callStartTime >= self::FROM_TIME && $callStartTime <= self::TO_TIME;
    }
}
