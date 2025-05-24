<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class HandlerFactory implements Contracts\HandlerFactory
{
    /** @var Collection<int, TypeHandler> */
    protected Collection $handlers;

    /**
     * @param  list<TypeHandler>  $handlers
     */
    public function __construct(array $handlers)
    {
        $this->handlers = collect($handlers);
    }

    public function for(AuraProperty $property): TypeHandler
    {
        return $this->handlers->first->satisfies($property)
            ?? throw new InvalidArgumentException("Property type [$property->type] unsupported.");
    }
}
