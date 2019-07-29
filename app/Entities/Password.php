<?php

namespace App\Entities;

use App\Entity;

class Password extends Entity
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
