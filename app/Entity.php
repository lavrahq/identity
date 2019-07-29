<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Entity extends Model
{
    /**
     * Boot the Model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($instance) {
            $instance->id = Str::uuid()->toString();
        });
    }

    /**
     * Return false to disable auto-incrementing key column.
     *
     * @return void
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Return 'string' to force the key to be of type string
     * instead of an integer.
     *
     * @return void
     */
    public function getKeyType()
    {
        return 'string';
    }
}
