<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class IntegerHandler implements TypeHandler
{
    public function __construct(protected Translator $translator) {}

    public function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['int', 'integer'], true);
    }

    public function description(AuraProperty $property): string
    {
        return $property->description;

        // $description = $this->translator->get($transKey);

        // return $description !== $transKey ? $description : $property->description;
    }

    public function component(): string
    {
        return 'model-editor::number';
    }

    public function handle(Request $request, Model $model, AuraProperty $property): void
    {
        $model->{$property->variableName} = (int) $request->{$property->variableName}; // @phpstan-ignore cast.int
    }

    public function validate(Request $request, AuraProperty $property): bool
    {
        return true;
    }
}
