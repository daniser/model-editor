<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Parsers;

use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionType;
use ReflectionUnionType;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraIntersectionType;
use TTBooking\ModelEditor\Entities\AuraNamedType;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraType;
use TTBooking\ModelEditor\Entities\AuraUnionType;
use TTBooking\ModelEditor\Exceptions\ParserException;

class ReflectionParser implements PropertyParser
{
    public function parse(object|string $objectOrClass): Aura
    {
        $refClass = new ReflectionClass($objectOrClass);
        $refProps = $refClass->getProperties(ReflectionProperty::IS_PUBLIC);

        $props = collect($refProps)->map(fn (ReflectionProperty $refProp) => new AuraProperty(
            readable: true,
            writable: ! $refProp->isReadOnly(),
            type: $this->parseType($refProp->getType()),
            variableName: $refProp->getName(),
            description: $refProp->getDocComment() ?: '',
            hasDefaultValue: $refProp->hasDefaultValue(),
            defaultValue: $refProp->getDefaultValue(),
        ));

        return new Aura(properties: $props->all());
    }

    /**
     * @throws ParserException
     */
    protected function parseType(?ReflectionType $refType): AuraType
    {
        return match (true) {
            is_null($refType) => new AuraNamedType('mixed', nullable: true),
            $refType instanceof ReflectionNamedType => new AuraNamedType($refType->getName(), nullable: $refType->allowsNull()),
            $refType instanceof ReflectionUnionType => new AuraUnionType($this->parseTypes($refType->getTypes()), nullable: $refType->allowsNull()),
            $refType instanceof ReflectionIntersectionType => new AuraIntersectionType($this->parseTypes($refType->getTypes()), $refType->allowsNull()),
            default => throw new ParserException('Unsupported node type.'),
        };
    }

    /**
     * @param  array<ReflectionType>  $refTypes
     * @return list<AuraType>
     *
     * @throws ParserException
     */
    protected function parseTypes(array $refTypes): array
    {
        return array_map(
            fn (ReflectionType $refType) => $this->parseType($refType),
            array_values($refTypes)
        );
    }
}
