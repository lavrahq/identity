<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Entity;

class Email extends Entity
{
    use Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
