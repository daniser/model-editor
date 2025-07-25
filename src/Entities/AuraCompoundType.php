<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

readonly class AuraCompoundType extends AuraType
{
    /**
     * @param  list<AuraType>  $types
     */
    final public function __construct(
        public array $types,
        public string $junction = '|',
        bool $nullable = false,
    ) {
        parent::__construct($nullable);
    }

    public function __toString(): string
    {
        return implode($this->junction, array_map(static function (AuraType $type) {
            return $type instanceof AuraCompoundType ? "($type)" : $type;
        }, $this->types));
    }
}
