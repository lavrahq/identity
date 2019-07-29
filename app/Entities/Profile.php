<?php

namespace App\Entities;

use App\Entity;

class Profile extends Entity
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
