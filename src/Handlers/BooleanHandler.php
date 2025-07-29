<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class BooleanHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return collect(['bool', 'boolean'])->contains($property->type->contains(...));
    }

    public function component(): string
    {
        return 'model-editor::form.checkbox';
    }

    public function handle(object $object, Request $request): void
    {
        $object->{$this->property->variableName} = $request->has($this->property->variableName);
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
