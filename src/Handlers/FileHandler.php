<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\PropertyHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Support\FilenameGenerator;
use TTBooking\ModelEditor\Types\File;
use function TTBooking\ModelEditor\Support\unquote;

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
        if (! $file = $request->file($this->property->variableName)) {
            return;
        }

        $name = FilenameGenerator::generateStorableName($object, $this->property, $file);
        $disk = $this->getDisk();

        if (! $name = $file->storeAs($name, compact('disk'))) {
            return;
        }

        if ($object->{$this->property->variableName} instanceof File) {
            $object->{$this->property->variableName}->delete();
        }

        $object->{$this->property->variableName} = new File($name, $disk, $this->getContentDisposition());
    }

    public function validate(Request $request): bool
    {
        return true;
    }

    protected function getDisk(): ?string
    {
        if ($disk = $this->property->type->parameters[0]->name ?? false) {
            return unquote($disk);
        }

        return config('model-editor.disk');
    }

    protected function getContentDisposition(): string
    {
        if ($contentDisposition = $this->property->type->parameters[2]->name ?? false) {
            return unquote($contentDisposition);
        }

        return config('model-editor.content_disposition', 'attachment');
    }
}
