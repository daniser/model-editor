<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

abstract readonly class AuraCompoundType extends AuraType
{
    /**
     * @param  list<AuraType>  $types
     */
    public function __construct(
        public array $types,
        public string $junction = '|',
        bool $nullable = false,
    ) {
        parent::__construct($nullable);
    }

    public function contains(string $type): bool
    {
        if ($type === (string) $this) {
            return true;
        }

        $method = $this->junction === '|' ? 'contains' : 'every';

        return collect($this->types)->$method(static fn (AuraType $auraType) => $auraType->contains($type));
    }

    public function __toString(): string
    {
        return implode($this->junction, array_map(static function (AuraType $type) {
            return $type instanceof static ? "($type)" : $type;
        }, $this->types));
    }
}
