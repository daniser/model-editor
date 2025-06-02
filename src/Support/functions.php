<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Support;

use Closure;
use Illuminate\Support\Str;

/**
 * @param  string|Closure(): string  $fallback
 */
function prop_desc(string $alias, string $property, string|Closure $fallback): string
{
    if (class_exists($alias)) {
        $alias = AliasResolver::resolveAlias($alias, 'Model');
    }

    $translator = app('translator');
    $appKey = sprintf('model-editor.model.%s.%s', $alias, Str::snake($property));
    $pkgKey = sprintf('model-editor::model.%s.%s', $alias, Str::snake($property));

    return $translator->has($appKey) ? $translator->get($appKey) : (
        $translator->has($pkgKey) ? $translator->get($pkgKey) : value($fallback)
    );
}

/**
 * @param  string|Closure(): string  $fallback
 */
function enum_desc(string $alias, string $case, string|Closure $fallback): string
{
    if (class_exists($alias)) {
        $alias = AliasResolver::resolveAlias($alias, 'Enum');
    }

    $translator = app('translator');
    $appKey = sprintf('model-editor.enum.%s.%s', $alias, Str::snake($case));
    $pkgKey = sprintf('model-editor::enum.%s.%s', $alias, Str::snake($case));

    return $translator->has($appKey) ? $translator->get($appKey) : (
        $translator->has($pkgKey) ? $translator->get($pkgKey) : value($fallback)
    );
}
