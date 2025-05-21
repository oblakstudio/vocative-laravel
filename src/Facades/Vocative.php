<?php

namespace Oblak\Vocative\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Oblak\Vocative\Vocative
 */
class Vocative extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Oblak\Vocative\Vocative::class;
    }
}
