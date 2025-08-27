<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Support\FilenameGenerator;
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

        $this->deleteFileIfNotDefault($object);

        $name = FilenameGenerator::generateStorableName($object, $this->property, $file);
        $disk = $this->getDisk();

        if (! $name = $file->storeAs($name, compact('disk'))) {
            return;
        }

        $object->{$this->property->variableName} = $this->newInstance($name, $disk);
    }

    public function validate(Request $request): bool
    {
        return true;
    }

    protected function deleteFileIfNotDefault(object $object): bool
    {
        $file = $object->{$this->property->variableName};
        if (! $file instanceof File) {
            return false;
        }

        if ($file->sameAs($this->property->defaultValue)) {
            return false;
        }

        return $file->delete();
    }

    protected function newInstance(string $name, ?string $disk = null): File
    {
        return new (static::TYPE)($name, $disk, $this->getContentDisposition());
    }

    protected function getDisk(): ?string
    {
        if (isset($this->property->type->parameters[0])) {
            return $this->property->type->parameters[0]->asConstExpr() ?? static::TYPE::disk();
        }

        return static::TYPE::disk();
    }

    protected function getContentDisposition(): string
    {
        if (isset($this->property->type->parameters[2])) {
            return $this->property->type->parameters[2]->asConstExpr() ?? static::TYPE::contentDisposition();
        }

        return static::TYPE::contentDisposition();
    }
}
