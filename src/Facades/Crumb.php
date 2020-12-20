<?php

namespace Log1x\Crumb\Facades;

use Illuminate\Support\Facades\Facade;

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
