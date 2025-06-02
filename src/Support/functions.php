<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Support;

use Closure;
use Illuminate\Support\Str;
use ReflectionEnumUnitCase;

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
 * @param  object|class-string  $objectOrClass
 * @param  null|string|Closure(): string  $fallback
 */
function enum_desc(object|string $objectOrClass, string $case, null|string|Closure $fallback = null): string
{
    $translator = app('translator');
    $alias = AliasResolver::resolveAlias($objectOrClass, 'Enum');
    $appKey = sprintf('model-editor.enum.%s.%s', $alias, Str::snake($case));
    $pkgKey = sprintf('model-editor::enum.%s.%s', $alias, Str::snake($case));

    $fallback ??= static function () use ($objectOrClass, $case) {
        $refCase = new ReflectionEnumUnitCase($objectOrClass, $case);
        $docComment = $refCase->getDocComment();

        return $docComment ? trim($docComment, "/* \n\r\t\v\0") : Str::headline($case);
    };

    return $translator->has($appKey) ? $translator->get($appKey) : (
        $translator->has($pkgKey) ? $translator->get($pkgKey) : value($fallback)
    );
}
