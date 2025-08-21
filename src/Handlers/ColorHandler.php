<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\Color;

class ColorHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return $property->type->contains(Color::class);
    }

    public function component(): string
    {
        return 'model-editor::form.color';
    }

    public function handle(object $object, Request $request): void
    {
        $object->{$this->property->variableName} = new Color($request->{$this->property->variableName});
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
