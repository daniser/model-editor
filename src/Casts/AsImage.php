<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use TTBooking\ModelEditor\Types\Image;

/**
 * @implements CastsAttributes<Image, Image>
 */
class AsImage extends AsFile implements CastsAttributes
{
    protected static string $type = Image::class;
}
