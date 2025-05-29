<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class EnumHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return is_subclass_of($property->type->name, BackedEnum::class);
    }

    public function component(): string
    {
        /** @var BackedEnum $enumClass */
        $enumClass = $this->property->type->name;

        return $enumClass::cases() > 3 ? 'model-editor::form.select' : 'model-editor::form.radio';
    }

    public function handle(Model $model, Request $request): void
    {
        /** @var class-string<BackedEnum> $enumClass */
        $enumClass = $this->property->type->name;

        // @phpstan-ignore-next-line
        $model->{$this->property->variableName} = $enumClass::from($request->{$this->property->variableName});
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
