<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Stringable;
use TTBooking\ModelEditor\Casts\AsColor;

class Color implements Castable, Stringable
{
    public function __construct(public string $value) {}

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array<string, mixed>  $arguments
     * @return class-string<AsColor>
     */
    public static function castUsing(array $arguments): string
    {
        return AsColor::class;
    }
}
