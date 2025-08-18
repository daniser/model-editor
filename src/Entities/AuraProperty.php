<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

use Stringable;

readonly class AuraProperty implements Stringable
{
    public function __construct(
        public bool $readable,
        public bool $writable,
        public AuraType $type,
        public string $variableName,
        public string $description,
        public bool $hasDefaultValue = false,
        public mixed $defaultValue = null,
    ) {}

    public function __toString(): string
    {
        return rtrim(sprintf('@property %s $%s %s', $this->type, $this->variableName, $this->description));
    }
}
