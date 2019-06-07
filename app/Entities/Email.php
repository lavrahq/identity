<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    use Notifiable;

    /**
     * Attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'receives_notices', 'receives_links', 'verified_at'
    ];

    /**
     * Attributes that should be cast to a specific type.
     *
     * @var array
     */
    protected $casts = [
        'verified_at',
    ];

    /**
     * Attributes that should be handled as dates.
     *
     * @var array
     */
    protected $dates = [
        'verified_at'
    ];

    /**
     * The User who owns this Email.
     *
     * @return User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
