<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Entities\AuraProperty;

interface TypeHandler
{
    public function satisfies(AuraProperty $property): bool;

    public function component(): string;

    public function validate(Request $request, AuraProperty $property): bool;
}
