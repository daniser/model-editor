<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

readonly class AuraNamedType extends AuraType
{
    /**
     * @param  list<AuraType>  $parameters
     */
    final public function __construct(
        public string $name,
        public array $parameters = [],
        bool $nullable = false,
    ) {
        parent::__construct($nullable);
    }

    public function __toString(): string
    {
        return $this->parameters ? sprintf('%s<%s>', $this->name, implode(', ', $this->parameters)) : $this->name;
    }
}
