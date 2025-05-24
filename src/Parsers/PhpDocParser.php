<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Parsers;

use Closure;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyRead;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionClass;
use Stringable;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraType;

class PhpDocParser implements PropertyParser
{
    public function __construct(protected Translator $translator) {}

    public function parse(Model|string $model): Aura
    {
        $docblock = DocBlockFactory::createInstance()->create(
            $refClass = new ReflectionClass($model),
            (new ContextFactory)->createFromReflector($refClass)
        );

        $modelType = /* Reflector::getClassAttribute($model, AccountExtType::class)?->type ?? */ Str::snake(class_basename($model));
        $transKey = "model.$modelType.";

        $props = collect(['property', 'property-read', 'property-write'])
            ->flatMap($docblock->getTagsByName(...))
            ->map(fn (Property|PropertyRead|PropertyWrite $property) => new AuraProperty(
                readable: $property instanceof Property || $property instanceof PropertyRead,
                writable: $property instanceof Property || $property instanceof PropertyWrite,
                type: AuraType::parse($property->getType()),
                variableName: $property->getVariableName(),
                description: $this->extractString($property->getDescription(...), $transKey.$property->getVariableName()),
            ));

        return new Aura(
            summary: $this->extractString($docblock->getSummary(...), $transKey.'_summary'),
            description: $this->extractString($docblock->getDescription(...), $transKey.'_description'),
            properties: $props->all(),
        );
    }

    /**
     * @phpstan-param  Closure(): Stringable|string  $callback
     */
    protected function extractString(Closure $callback, ?string $transKey = null): string
    {
        if (isset($transKey)) {
            $localized = $this->translator->get($transKey);
        }

        return isset($localized) && $localized !== $transKey ? $localized : (string) $callback();
    }
}
