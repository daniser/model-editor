<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraUnionType;

class UnionHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return $property->type instanceof AuraUnionType;
    }

    public function component(): string
    {
        // TODO: Implement component() method.
    }

    public function handle(object $object, Request $request): void
    {
        // TODO: Implement handle() method.
    }

    public function validate(Request $request): bool
    {
        // TODO: Implement validate() method.
    }
}
