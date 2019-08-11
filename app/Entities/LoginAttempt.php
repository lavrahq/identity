<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entity;
use App\Entities\User;

class LoginAttempt extends Entity
{
    /**
     * The IP Address
     *
     * @return void
     */
    public function ipAddress()
    {
        return $this->belongsTo(IpAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
