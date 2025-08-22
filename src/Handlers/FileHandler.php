<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\File;

class FileHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return is_a($property->type->name, File::class, true)
            || $property->type->name === 'list' && is_a($property->type->parameters[0]->name, File::class, true);
    }

    public function component(): string
    {
        return 'model-editor::form.file';
    }

    public function handle(object $object, Request $request): void
    {
        if (! $name = $request->file($this->property->variableName)?->store()) {
            return;
        }

        if ($object->{$this->property->variableName} instanceof File) {
            $object->{$this->property->variableName}->delete();
        }

        $object->{$this->property->variableName} = new File($name);
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
