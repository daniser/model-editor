<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Parsers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\ContextFactory;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocChildNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PropertyTagValueNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use ReflectionClass;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraType;

class PhpStanParser implements PropertyParser
{
    public function parse(Model|string $model): Aura
    {
        $refClass = new ReflectionClass($model);

        if (! $docComment = $refClass->getDocComment()) {
            return new Aura;
        }

        $config = new ParserConfig([]);
        $lexer = new Lexer($config);
        $constExprParser = new ConstExprParser($config);
        $typeParser = new TypeParser($config, $constExprParser);
        $phpDocParser = new PhpDocParser($config, $typeParser, $constExprParser);

        $tokens = new TokenIterator($lexer->tokenize($docComment));
        $phpDocNode = $phpDocParser->parse($tokens);

        $context = (new ContextFactory)->createFromReflector($refClass);
        $typeResolver = new TypeResolver;
        $resolver = static fn (string $type) => ltrim((string) $typeResolver->resolve($type, $context), '\\');

        $props = collect(['@property', '@property-read', '@property-write'])
            ->flatMap($phpDocNode->getPropertyTagValues(...))
            ->map(fn (PropertyTagValueNode $property) => new AuraProperty(
                readable: true,
                writable: true,
                type: AuraType::parse($property->type, $resolver),
                variableName: ltrim($property->propertyName, '$'),
                description: $property->description,
            ));

        $comment = (string) Arr::first($phpDocNode->children, static fn (PhpDocChildNode $child) => $child instanceof PhpDocTextNode);
        [$summary, $description] = explode("\n\n", $comment, 2) + ['', ''];

        return new Aura(
            summary: $summary,
            description: $description,
            properties: $props->all(),
        );
    }
}
