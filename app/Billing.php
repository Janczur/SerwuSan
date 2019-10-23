<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = ['name', 'owner_id', 'working_days_rate', 'saturday_rate'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
