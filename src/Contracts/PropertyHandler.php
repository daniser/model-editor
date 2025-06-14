<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Entities\AuraProperty;

interface PropertyHandler
{
    public static function satisfies(AuraProperty $property): bool;

    public function component(): string;

    public function handle(Model $model, Request $request): void;

    public function validate(Request $request): bool;
}
