<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class FloatHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return collect(['float', 'double', 'real'])->contains($property->type->contains(...));
    }

    public function component(): string
    {
        return 'model-editor::form.decimal';
    }

    public function handle(object $object, Request $request): void
    {
        $object->{$this->property->variableName} = (float) $request->{$this->property->variableName}; // @phpstan-ignore cast.double
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
