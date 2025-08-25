<?php

namespace Laravel\CvAgent\Facades;

use Illuminate\Support\Facades\Facade;

class CvSections extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraCare\CvAgent\Services\CvSectionsGenerator::class;
    }
}
