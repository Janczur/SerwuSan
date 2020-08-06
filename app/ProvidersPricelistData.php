<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProvidersPricelistData extends Model
{
    protected $table = 'providers_pricelists_data';
    protected $fillable = [
        'pricelist_id',
        'country',
        'description',
        'operator',
        'type',
        'prefix',
        't1',
        't2',
        't3',
        'period1',
        'period2',
        'init_charge',
        'price_for_time',
        'currency'
    ];
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function providersPricelist(): BelongsTo
    {
        return $this->belongsTo(ProvidersPricelist::class, 'id', 'pricelist_id');
    }
}
