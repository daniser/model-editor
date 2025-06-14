<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class FallbackHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return true;
    }

    public function component(): string
    {
        return 'model-editor::form.disclaimer';
    }

    public function handle(Model $model, Request $request): void
    {
        //
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
