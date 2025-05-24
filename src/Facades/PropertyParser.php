<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use TTBooking\ModelEditor\Contracts\PropertyParser as PropertyParserContract;
use TTBooking\ModelEditor\Entities\Aura;

/**
 * @method static PropertyParserContract driver(string|null $driver = null)
 * @method static Aura parse(Model|string $model)
 *
 * @see \TTBooking\ModelEditor\PropertyParserManager
 */
class PropertyParser extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'property-parser';
    }
}
