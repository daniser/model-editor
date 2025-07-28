<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Support\Manager;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Parsers\PhpDocParser;
use TTBooking\ModelEditor\Parsers\PhpStanParser;
use TTBooking\ModelEditor\Parsers\ReflectionParser;

class PropertyParserManager extends Manager implements PropertyParser
{
    public function createPhpdocDriver(): PhpDocParser
    {
        return $this->container->make(PhpDocParser::class);
    }

    public function createPhpstanDriver(): PhpStanParser
    {
        return $this->container->make(PhpStanParser::class);
    }

    public function createReflectionParser(): ReflectionParser
    {
        return $this->container->make(ReflectionParser::class);
    }

    public function parse(object|string $objectOrClass): Aura
    {
        return $this->driver()->parse($objectOrClass);
    }

    public function getDefaultDriver(): string
    {
        /** @var string */
        return $this->config->get('model-editor.property_parser.driver', 'phpstan');
    }
}
