<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return HasMany
     */
    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class, 'owner_id');
    }

    /**
     * @return HasMany
     */
    public function providersPricelists(): HasMany
    {
        return $this->hasMany(ProvidersPricelist::class, 'owner_id');
    }
}
