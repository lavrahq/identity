<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    /**
     * Attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'banned_at', 'last_seen_at'
    ];

    /**
     * Attributes that must be cast to specific types.
     *
     * @var array
     */
    protected $casts = [
        'banned_at' => 'datetime',
        'last_seen_at' => 'datetime'
    ];

    /**
     * Attributes that should be considered dates.
     *
     * @var array
     */
    protected $dates = [
        'banned_at', 'last_seen_at'
    ];
}
