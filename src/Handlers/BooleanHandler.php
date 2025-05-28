<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class BooleanHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property, protected Translator $translator) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['bool', 'boolean'], true);
    }

    public function component(): string
    {
        return 'model-editor::form.checkbox';
    }

    public function handle(Model $model, Request $request): void
    {
        $model->{$this->property->variableName} = $request->has($this->property->variableName);
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
