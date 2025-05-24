<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class StringHandler implements TypeHandler
{
    public function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['string', 'non-empty-string', 'class-string'], true);
    }

    public function component(): string
    {
        return 'model-editor::text';
    }

    public function validate(Request $request, AuraProperty $property): bool
    {
        return true;
    }
}
