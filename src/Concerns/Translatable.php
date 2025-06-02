<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Concerns;

use Closure;
use Illuminate\Support\Str;

trait Translatable
{
    /**
     * @param  string|Closure(): string  $fallback
     */
    public function getPropertyDescription(string $alias, string $property, string|Closure $fallback): string
    {
        $appKey = sprintf('model-editor.model.%s.%s', $alias, Str::snake($property));
        $pkgKey = sprintf('model-editor::model.%s.%s', $alias, Str::snake($property));

        return $this->translator->has($appKey) ? $this->translator->get($appKey) : (
            $this->translator->has($pkgKey) ? $this->translator->get($pkgKey) : value($fallback)
        );
    }

    public function getEnumDescription(string $alias, string $case, string|Closure $fallback): string
    {
        $appKey = sprintf('model-editor.enum.%s.%s', $alias, Str::snake($case));
        $pkgKey = sprintf('model-editor::enum.%s.%s', $alias, Str::snake($case));

        return $this->translator->has($appKey) ? $this->translator->get($appKey) : (
            $this->translator->has($pkgKey) ? $this->translator->get($pkgKey) : value($fallback)
        );
    }
}
