<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Casts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use RuntimeException;
use TTBooking\ModelEditor\Types\File;

/**
 * @implements CastsAttributes<File, File>
 */
class AsFile implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?File
    {
        if (is_null($value)) {
            return null;
        }

        if (! is_string($value)) {
            throw new RuntimeException('File name must be a string.');
        }

        return new File($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return isset($value) ? (string) $value : null;
    }
}
