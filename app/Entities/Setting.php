<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'label', 'description', 'key', 'value', 'default', 'type'
    ];
}
