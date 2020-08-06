<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProvidersPricelist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'owner_id'];

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
    public function providersPricelistData(): HasMany
    {
        return $this->hasMany(ProvidersPricelistData::class, 'pricelist_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function maxValuesWithoutDuplicates(): HasMany
    {
        return $this->hasMany(ProvidersPricelistData::class, 'pricelist_id', 'id')
            ->groupBy('country')->select(['id', 'country', 't1', 't2']);
    }
}
