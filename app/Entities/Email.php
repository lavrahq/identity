<?php

namespace App\Entities;

use App\Entity;
use Illuminate\Notifications\Notifiable;

class Email extends Entity
{
    use Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
