<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

interface Comparable
{
    public function sameAs(mixed $that): bool;
}
