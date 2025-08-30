<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\File;

class FileHandler implements PropertyHandler
{
    /** @var class-string<File> */
    protected const TYPE = File::class;

    public function __construct(public AuraProperty $property) {}

    public static function satisfies(AuraProperty $property): bool
    {
        return is_a($property->type->name, static::TYPE, true)
            || $property->type->name === 'list' && is_a($property->type->parameters[0]->name, static::TYPE, true);
    }

    public function component(): string
    {
        return 'model-editor::form.file';
    }

    public function handle(object $object, Request $request): void
    {
        if (! $file = $request->file($this->property->variableName)) {
            return;
        }

        $this->deleteFileIfNotStaticOrDefault($object);

        $disk = $this->getDisk();
        $name = File::generateStorableName($object, $this->property, $file, $disk);

        if (! $name = $file->storeAs($name, compact('disk'))) {
            return;
        }

        $object->{$this->property->variableName} = $this->newInstance($name, $disk);
    }

    public function validate(Request $request): bool
    {
        return true;
    }

    protected function deleteFileIfNotStaticOrDefault(object $object): bool
    {
        $maybeFile = $object->{$this->property->variableName};

        return $maybeFile instanceof File
            && ! str_starts_with($maybeFile->name, '/')
            && ! $maybeFile->sameAs($this->property->defaultValue)
            && $maybeFile->delete();
    }

    protected function newInstance(string $name, ?string $disk = null): File
    {
        return new (static::TYPE)($name, $disk, $this->getContentDisposition());
    }

    protected function getDisk(): ?string
    {
        if (isset($this->property->type->parameters[2])) {
            return $this->property->type->parameters[2]->asConstExpr() ?? static::TYPE::disk();
        }

        return static::TYPE::disk();
    }

    protected function getContentDisposition(): string
    {
        if (isset($this->property->type->parameters[1])) {
            return $this->property->type->parameters[1]->asConstExpr() ?? static::TYPE::contentDisposition();
        }

        return static::TYPE::contentDisposition();
    }
}
