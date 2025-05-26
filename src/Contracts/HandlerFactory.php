<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use InvalidArgumentException;
use TTBooking\ModelEditor\Entities\AuraProperty;

interface HandlerFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function for(AuraProperty $property): PropertyHandler;
}
