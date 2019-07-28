<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entity;

class Profile extends Entity
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
