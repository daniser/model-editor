<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class HandlerFactory implements Contracts\HandlerFactory
{
    /** @var Collection<int, class-string<TypeHandler>> */
    protected Collection $handlers;

    /**
     * @param  list<class-string<TypeHandler>>  $handlers
     */
    public function __construct(protected Container $container, array $handlers)
    {
        $this->handlers = collect($handlers);
    }

    public function for(AuraProperty $property): TypeHandler
    {
        $handlerClass = $this->handlers->first->satisfies($property)
            ?? throw new InvalidArgumentException("Property type [$property->type] unsupported.");

        return $this->container->make($handlerClass, compact('property'));
    }
}
