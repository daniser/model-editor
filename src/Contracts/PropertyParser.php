<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use TTBooking\ModelEditor\Entities\Aura;

interface PropertyParser
{
    /**
     * @param  object|class-string  $objectOrClass
     */
    public function parse(object|string $objectOrClass): Aura;
}
