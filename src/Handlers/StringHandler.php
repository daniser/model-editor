<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class StringHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['string', 'non-empty-string', 'class-string'], true);
    }

    public function component(): string
    {
        return 'model-editor::form.text';
    }

    public function handle(Model $model, Request $request): void
    {
        $model->{$this->property->variableName} = $request->{$this->property->variableName};
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
