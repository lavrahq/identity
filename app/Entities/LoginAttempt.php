<?php

namespace App\Entities;

use App\Entity;

class LoginAttempt extends Entity
{
    /**
     * The IP Address.
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
