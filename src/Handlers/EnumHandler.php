<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use ReflectionEnum;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;

class EnumHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property, protected int $buttonLimit = 3) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return is_subclass_of($property->type->name, BackedEnum::class);
    }

    public function component(): string
    {
        /** @var class-string<BackedEnum> $enumClass */
        $enumClass = $this->property->type->name;

        return count($enumClass::cases()) > $this->buttonLimit
            ? 'model-editor::form.select'
            : 'model-editor::form.radio';
    }

    public function handle(Model $model, Request $request): void
    {
        /** @var class-string<BackedEnum> $enumClass */
        $enumClass = $this->property->type->name;

        $intBacked = (new ReflectionEnum($enumClass))->getBackingType()?->getName() === 'int';

        $model->{$this->property->variableName} = $intBacked
            ? $enumClass::from($request->integer($this->property->variableName))
            : $enumClass::from((string) $request->string($this->property->variableName));
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
