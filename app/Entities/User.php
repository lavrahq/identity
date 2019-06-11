<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'timezone',
    ];

    public function passwords() : HasMany
    {
        return $this->hasMany(Password::class);
    }

    public function currentPassword() : Password
    {
        return $this->passwords()
            ->where('expired_at', null)
            ->orWhere('expired_at', '>', now())
            ->first();
    }

}
