<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

readonly class AuraIntersectionType extends AuraCompoundType
{
    /**
     * @param  list<AuraType>  $types
     */
    final public function __construct(array $types, bool $nullable = false)
    {
        parent::__construct($types, '&', $nullable);
    }
}
