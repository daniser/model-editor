<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use TTBooking\ModelEditor\Casts\AsImage;

/**
 * @template TDisk of string|null = null
 * @template TAccept of string = "image/*"
 * @template TDisposition of string = "inline"
 *
 * @extends File<TDisk, TAccept, TDisposition>
 */
class Image extends File
{
    /**
     * @param  TDisk  $disk
     * @param  TDisposition  $contentDisposition
     */
    public function __construct(string $name, ?string $disk = null, string $contentDisposition = 'inline')
    {
        parent::__construct($name, $disk, $contentDisposition);
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array<string, mixed>  $arguments
     * @return class-string<AsImage>
     */
    public static function castUsing(array $arguments): string
    {
        return AsImage::class;
    }
}
