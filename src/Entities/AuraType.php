<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

use Stringable;

abstract readonly class AuraType implements Stringable
{
    public function __construct(public bool $nullable = false) {}
}
