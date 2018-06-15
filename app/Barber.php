<?php

namespace App;

class Barber extends User
{
    protected $table = 'users';

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('is_barber', true);
        });
    }
}
