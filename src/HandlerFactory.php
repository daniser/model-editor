<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class HandlerFactory implements Contracts\HandlerFactory
{
    /** @var Collection<int, class-string<PropertyHandler>> */
    protected Collection $handlers;

    /**
     * @param  list<class-string<PropertyHandler>>  $handlers
     */
    public function __construct(protected Container $container, array $handlers)
    {
        $this->handlers = collect($handlers);
    }

    public function for(AuraProperty $property): PropertyHandler
    {
        $handlerClass = $this->handlers->first(static fn (string $handlerClass) => $handlerClass::satisfies($property))
            ?? throw new InvalidArgumentException("Property type [$property->type] unsupported.");

        return $this->container->make($handlerClass, compact('property'));
    }
}
