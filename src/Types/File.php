<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Support\Facades\Storage;
use JsonSerializable;
use Stringable;
use TTBooking\ModelEditor\Casts\AsFile;

/**
 * @template TDisk of string|null = null
 * @template TAccept of string = "\*\/\*"
 * @template TDisposition of string = "attachment"
 */
class File implements Castable, JsonSerializable, Stringable
{
    /**
     * @param  TDisk  $disk
     * @param  TDisposition  $contentDisposition
     */
    public function __construct(
        public string $name,
        public ?string $disk = null,
        public string $contentDisposition = 'attachment',
    ) {}

    public function __toString(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): string
    {
        return $this->name;
    }

    public function exists(): bool
    {
        return Storage::disk($this->disk)->exists($this->name);
    }

    public function getContent(): ?string
    {
        return Storage::disk($this->disk)->get($this->name);
    }

    /**
     * @internal
     */
    public function delete(): bool
    {
        return Storage::disk($this->disk)->delete($this->name);
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array<string, mixed>  $arguments
     * @return class-string<AsFile>
     */
    public static function castUsing(array $arguments): string
    {
        return AsFile::class;
    }
}
