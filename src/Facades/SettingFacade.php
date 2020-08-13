<?php

namespace Inewtonua\Setting\Facades;

use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Setting';
    }
}