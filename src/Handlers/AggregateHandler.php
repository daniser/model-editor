<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

/**
 * @deprecated
 */
class AggregateHandler implements TypeHandler
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

    public function satisfies(AuraProperty $property): bool
    {
        return $this->handlers->some->satisfies($property);
    }

    public function component(): string
    {
        return $this->handlers->first->satisfies($property)?->component($model, $property);
    }

    public function validate(Request $request, AuraProperty $property): bool
    {
        return $this->handlers->first->satisfies($property)->validate($request, $property);
    }
}
