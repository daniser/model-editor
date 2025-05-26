<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Entities\AuraProperty;

interface TypeHandler
{
    public function satisfies(AuraProperty $property): bool;

    public function description(AuraProperty $property): string;

    public function component(): string;

    public function handle(Request $request, Model $model, AuraProperty $property): void;

    public function validate(Request $request, AuraProperty $property): bool;
}
