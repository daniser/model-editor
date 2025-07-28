<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Parsers;

use phpDocumentor\Reflection\DocBlock\Tags\Property;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyRead;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionClass;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraType;

class PhpDocParser implements PropertyParser
{
    public function parse(object|string $objectOrClass): Aura
    {
        $docblock = DocBlockFactory::createInstance()->create(
            $refClass = new ReflectionClass($objectOrClass),
            (new ContextFactory)->createFromReflector($refClass)
        );

        $props = collect(['property', 'property-read', 'property-write'])
            ->flatMap($docblock->getTagsByName(...))
            ->map(fn (Property|PropertyRead|PropertyWrite $property) => new AuraProperty(
                readable: $property instanceof Property || $property instanceof PropertyRead,
                writable: $property instanceof Property || $property instanceof PropertyWrite,
                type: AuraType::parse($property->getType()),
                variableName: $property->getVariableName(),
                description: (string) $property->getDescription(),
            ));

        return new Aura(
            summary: $docblock->getSummary(),
            description: (string) $docblock->getDescription(),
            properties: $props->all(),
        );
    }
}
