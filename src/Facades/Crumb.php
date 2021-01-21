<?php

namespace Log1x\Crumb\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection build()
 *
 * @see \Log1x\Crumb\Crumb
 */
class Crumb extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'crumb';
    }
}
