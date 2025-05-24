<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

readonly class Aura
{
    /**
     * @param  list<AuraProperty>  $properties
     */
    public function __construct(
        public string $summary = '',
        public string $description = '',
        public array $properties = [],
    ) {}
}
