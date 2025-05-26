<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Facades;

use Illuminate\Support\Facades\Facade;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Contracts\PropertyHandler as PropertyHandlerContract;

/**
 * @method static PropertyHandlerContract for(AuraProperty $property)
 *
 * @see \TTBooking\ModelEditor\HandlerFactory
 */
class PropertyHandler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'property-handler';
    }
}
