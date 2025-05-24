<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Manager;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Parsers\PhpDocParser;
use TTBooking\ModelEditor\Parsers\PhpStanParser;

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

    public function parse(Model|string $model): Aura
    {
        return $this->driver()->parse($model);
    }

    public function getDefaultDriver(): string
    {
        /** @var string */
        return $this->config->get('model-editor.property_parser.driver', 'phpstan');
    }
}
