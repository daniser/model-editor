<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

use Stringable;

class Color implements Stringable
{
    public function __construct(public string $value) {}

    public function __toString(): string
    {
        return $this->value;
    }
}
