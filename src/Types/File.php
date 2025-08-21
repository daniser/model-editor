<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use Illuminate\Contracts\Database\Eloquent\Castable;
use JsonSerializable;
use Stringable;
use TTBooking\ModelEditor\Casts\AsFile;

/**
 * @template TAccept of string = "*\/*"
 */
class File implements Castable, JsonSerializable, Stringable
{
    public function __construct(public string $name) {}

    public function __toString(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): string
    {
        return $this->name;
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
