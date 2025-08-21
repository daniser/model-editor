<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\File;

class FileHandler implements PropertyHandler
{
    public function __construct(public AuraProperty $property, protected Filesystem $files) {}

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
        if ($object->{$this->property->variableName}) {
            $this->files->delete($object->{$this->property->variableName});
        }

        $object->{$this->property->variableName} = $request->file($this->property->variableName)->store();
    }

    public function validate(Request $request): bool
    {
        return true;
    }
}
