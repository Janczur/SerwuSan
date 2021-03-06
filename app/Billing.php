<?php

namespace App;

use App\Helpers\BillingCalculations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Billing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'owner_id', 'working_days_rate', 'weekend_rate', 'settlement', 'imported'];

    /**
     * The array of billingData to create from
     *
     * @var array
     */
    private $rawData = [];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function billingData(): HasMany
    {
        return $this->hasMany(BillingData::class);
    }

    /**
     * @return array
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }

    /**
     * @param array $rawData
     */
    public function setRawData(array $rawData): void
    {
        $this->rawData = $rawData;
    }

    /**
     * @return float calculated settlement of billing
     */
    public function calculateSettlement(): float
    {
        $billingCalculations = new BillingCalculations();
        return $billingCalculations->calculateSettlement($this);
    }

    /**
     * divide the data to be saved into chunks of 10,000 records so that the SQL does not explode or reject insert
     *
     * @return bool
     */
    public function saveBillingData(): bool
    {
        $chunkedData = array_chunk($this->rawData, 10000);
        foreach ($chunkedData as $data){
            BillingData::insert($data);
        }
        return true;
    }
}
