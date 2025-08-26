<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\Image;

class ImageHandler extends FileHandler
{
    public static function satisfies(AuraProperty $property): bool
    {
        return is_a($property->type->name, Image::class, true)
            || $property->type->name === 'list' && is_a($property->type->parameters[0]->name, Image::class, true);
    }

    public function component(): string
    {
        return 'model-editor::form.image';
    }

    protected function newInstance(string $name, ?string $disk = null): Image
    {
        return new Image($name, $disk, $this->getContentDisposition());
    }

    protected function getDefaultContentDisposition(): string
    {
        return 'inline';
    }
}
