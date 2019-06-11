<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Password extends Model
{

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
