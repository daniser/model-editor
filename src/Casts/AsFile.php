<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Casts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use RuntimeException;
use TTBooking\ModelEditor\Types\File;
use TypeError;

/**
 * @implements CastsAttributes<File, File>
 */
class AsFile implements CastsAttributes
{
    /** @var class-string<File> */
    protected static string $type = File::class;

    public function __construct(protected string $disk = '', protected string $contentDisposition = '') {}

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

        return new (static::$type)(
            ltrim($value, '$'),
            $this->getDisk($value),
            $this->contentDisposition ?: static::$type::contentDisposition()
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (! $value instanceof static::$type) {
            throw new TypeError(sprintf(
                'Cannot assign %s to property %s::$%s of type %s',
                get_debug_type($value), get_class($model), $key, static::$type
            ));
        }

        return (string) $value;
    }

    protected function getDisk(string $value): ?string
    {
        if (str_starts_with($value, '$')) {
            return static::$type::staticDisk();
        }

        return $this->disk ?: static::$type::disk();
    }
}
