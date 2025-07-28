<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Parsers;

use Closure;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\ContextFactory;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocChildNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PropertyTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\ConstTypeNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use ReflectionClass;
use TTBooking\ModelEditor\Contracts\PropertyParser;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraIntersectionType;
use TTBooking\ModelEditor\Entities\AuraNamedType;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Entities\AuraType;
use TTBooking\ModelEditor\Entities\AuraUnionType;
use TTBooking\ModelEditor\Exceptions\ParserException;

class PhpStanParser implements PropertyParser
{
    public function parse(object|string $objectOrClass): Aura
    {
        $refClass = new ReflectionClass($objectOrClass);

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
                type: $this->parseType($property->type, $resolver),
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

    /**
     * @param  null|Closure(string): string  $typeResolver
     *
     * @throws ParserException
     */
    protected function parseType(TypeNode $type, ?Closure $typeResolver = null): AuraType
    {
        $typeResolver ??= static fn (string $type) => $type;

        return match (true) {
            $type instanceof UnionTypeNode => new AuraUnionType($this->parseTypes($type->types, $typeResolver)),
            $type instanceof IntersectionTypeNode => new AuraIntersectionType($this->parseTypes($type->types, $typeResolver)),
            $type instanceof IdentifierTypeNode => new AuraNamedType($typeResolver($type->name)),
            $type instanceof GenericTypeNode => new AuraNamedType(
                $typeResolver($type->type->name),
                $this->parseTypes($type->genericTypes, $typeResolver)
            ),
            $type instanceof ConstTypeNode => new AuraNamedType((string) $type->constExpr),
            default => throw new ParserException('Unsupported node type.'),
        };
    }

    /**
     * @param  array<TypeNode>  $types
     * @param  null|Closure(string): string  $typeResolver
     * @return list<AuraType>
     *
     * @throws ParserException
     */
    protected function parseTypes(array $types, ?Closure $typeResolver = null): array
    {
        return array_map(
            fn (TypeNode $type) => $this->parseType($type, $typeResolver),
            array_values($types)
        );
    }
}
