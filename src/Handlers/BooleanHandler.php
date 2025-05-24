<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class BooleanHandler implements TypeHandler
{
    public function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['bool', 'boolean'], true);
    }

    public function component(): string
    {
        return 'model-editor::components.checkbox';
    }

    public function validate(Request $request, AuraProperty $property): bool
    {
        return true;
    }
}
