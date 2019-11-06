<?php

namespace App;

use App\Imports\BillingDataImporter;
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
    protected $fillable = ['name', 'owner_id', 'working_days_rate', 'saturday_rate'];

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
}
