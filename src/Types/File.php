<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use Stringable;

/**
 * @template TAccept of string
 */
class File implements Stringable
{
    public function __construct(public string $name) {}

    public function __toString(): string
    {
        return $this->name;
    }
}
