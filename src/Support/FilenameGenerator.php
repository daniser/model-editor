<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Support;

use Closure;
use Illuminate\Http\UploadedFile;
use TTBooking\ModelEditor\Entities\AuraProperty;

class FilenameGenerator
{
    /** @var null|Closure(object, AuraProperty, UploadedFile, string|null): string */
    protected static ?Closure $storableNamesGenerator = null;

    public static function generateStorableName(
        object $object,
        AuraProperty $property,
        UploadedFile $file,
        ?string $disk = null,
    ): string {
        return static::$storableNamesGenerator
            ? (static::$storableNamesGenerator)($object, $property, $file, $disk)
            : $file->hashName();
    }

    /**
     * @param  Closure(object $object, AuraProperty $property, UploadedFile $file, string|null $disk): string  $callback
     * @return class-string<static>
     */
    public static function generateStorableNamesUsing(Closure $callback): string
    {
        static::$storableNamesGenerator = $callback;

        return static::class;
    }

    /**
     * @return class-string<static>
     */
    public static function generateStorableNamesNormally(): string
    {
        static::$storableNamesGenerator = null;

        return static::class;
    }
}
