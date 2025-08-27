<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use TTBooking\ModelEditor\Types\Image;

class ImageHandler extends FileHandler
{
    protected static string $type = Image::class;

    public function component(): string
    {
        return 'model-editor::form.image';
    }
}
