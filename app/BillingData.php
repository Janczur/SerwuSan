<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingData extends Model
{
    protected $table = 'billings_data';
    protected $fillable = ['billing_id', 'call_start_date', 'call_duration'];
    public $timestamps = false;

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}
