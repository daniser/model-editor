<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Support;

use Closure;
use Illuminate\Http\UploadedFile;
use TTBooking\ModelEditor\Entities\AuraProperty;

class FilenameGenerator
{
    /** @var null|Closure(object, AuraProperty, UploadedFile): string */
    protected static ?Closure $storableNamesGenerator = null;

    public static function generateStorableName(object $object, AuraProperty $property, UploadedFile $file): string
    {
        return static::$storableNamesGenerator
            ? (static::$storableNamesGenerator)($object, $property, $file)
            : $file->hashName();
    }

    /**
     * @param  Closure(object $object, AuraProperty $property, UploadedFile $file): string  $callback
     */
    public static function generateStorableNamesUsing(Closure $callback): string
    {
        static::$storableNamesGenerator = $callback;

        return static::class;
    }

    public static function generateStorableNamesNormally(): string
    {
        static::$storableNamesGenerator = null;

        return static::class;
    }
}
