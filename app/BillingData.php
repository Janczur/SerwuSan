<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingData extends Model
{
    protected $table = 'billings_data';
    protected $fillable = ['billing_id', 'call_start_date', 'call_duration'];
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function billing(): BelongsTo
    {
        return $this->belongsTo(Billing::class);
    }
}
