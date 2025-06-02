<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Support;

use Closure;
use Illuminate\Support\Str;
use ReflectionEnumUnitCase;
use UnitEnum;

/**
 * @param  object|class-string  $objectOrClass
 * @param  null|string|Closure(): string  $fallback
 */
function prop_desc(object|string $objectOrClass, string $property, null|string|Closure $fallback = null): string
{
    $translator = app('translator');
    $alias = AliasResolver::resolveAlias($objectOrClass, 'Model');
    $appKey = sprintf('model-editor.model.%s.%s', $alias, Str::snake($property));
    $pkgKey = sprintf('model-editor::model.%s.%s', $alias, Str::snake($property));
    $fallback ??= static fn () => Str::headline($property);

    return $translator->has($appKey) ? $translator->get($appKey) : (
        $translator->has($pkgKey) ? $translator->get($pkgKey) : value($fallback)
    );
}

/**
 * @param  null|string|Closure(): string  $fallback
 */
function enum_desc(UnitEnum $case, null|string|Closure $fallback = null): string
{
    $translator = app('translator');
    $alias = AliasResolver::resolveAlias($case, 'Enum');
    $appKey = sprintf('model-editor.enum.%s.%s', $alias, Str::snake($case->name));
    $pkgKey = sprintf('model-editor::enum.%s.%s', $alias, Str::snake($case->name));

    $fallback ??= static function () use ($case) {
        $refCase = new ReflectionEnumUnitCase($case, $case->name);
        $docComment = $refCase->getDocComment();

        return $docComment ? trim($docComment, "/* \n\r\t\v\0") : Str::headline($case->name);
    };

    return $translator->has($appKey) ? $translator->get($appKey) : (
        $translator->has($pkgKey) ? $translator->get($pkgKey) : value($fallback)
    );
}
