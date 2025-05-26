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
    public function __construct(public AuraProperty $property, protected Translator $translator) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return in_array($property->type->name, ['int', 'integer'], true);
    }

    public function description(): string
    {
        return $this->property->description;

        // $description = $this->translator->get($transKey);

        // return $description !== $transKey ? $description : $this->property->description;
    }

    public function component(): string
    {
        return 'model-editor::number';
    }

    public function handle(Model $model, Request $request): void
    {
        $model->{$this->property->variableName} = (int) $request->{$this->property->variableName}; // @phpstan-ignore cast.int
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
