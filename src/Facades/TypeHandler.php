<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Facades;

use Illuminate\Support\Facades\Facade;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Contracts\TypeHandler as TypeHandlerContract;

/**
 * @method static TypeHandlerContract for(AuraProperty $property)
 *
 * @see \TTBooking\ModelEditor\HandlerFactory
 */
class TypeHandler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'type-handler';
    }
}
