<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entity;

class IpAddress extends Entity
{
    protected $fillable = [
        'ip_address'
    ];
}
