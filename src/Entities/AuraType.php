<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Entities;

use Closure;
use InvalidArgumentException;
use Stringable;

readonly class AuraType implements Stringable
{
    /** @var list<static> */
    public array $parameters;

    /**
     * @param  list<static|string>  $parameters
     * @param  null|Closure(string): class-string  $typeResolver
     */
    final public function __construct(public string $name, array $parameters = [], ?Closure $typeResolver = null)
    {
        $this->parameters = array_map(
            static fn (self|string $parameter) => static::parse($parameter, $typeResolver), $parameters
        );
    }

    /**
     * @param  null|Closure(string): class-string  $typeResolver
     */
    public static function parse(string|Stringable $type, ?Closure $typeResolver = null): static
    {
        if ($type instanceof static) {
            return $type;
        }

        $typeResolver ??= static fn (string $type) => $type;

        // TODO: fix matching nested generics
        if (! preg_match('/^(.+?)(?:<(.+?)>)?$/', (string) $type, $matches)) {
            throw new InvalidArgumentException("Invalid type string: \"$type\".");
        }

        return new static(
            name: $typeResolver($matches[1]),
            parameters: array_filter(array_map('trim', explode(',', $matches[2] ?? ''))),
            typeResolver: $typeResolver,
        );
    }

    public function __toString(): string
    {
        return $this->parameters ? sprintf('%s<%s>', $this->name, implode(', ', $this->parameters)) : $this->name;
    }
}
