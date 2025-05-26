<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Model update(Request $request, Model $model)
 *
 * @see \TTBooking\ModelEditor\ActionHandler
 */
class ActionHandler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'action-handler';
    }
}
