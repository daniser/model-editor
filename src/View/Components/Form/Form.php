<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Reflector;
use Illuminate\Support\Stringable;
use Illuminate\View\Component;
use InvalidArgumentException;
use TTBooking\ModelEditor\Attributes\Alias;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Facades\PropertyParser;

class Form extends Component
{
    public Aura $aura;

    public string $alias;

    public string $summary;

    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(protected Translator $translator, public Model $model)
    {
        $this->aura = PropertyParser::parse($model);
        $this->alias = static::resolveAlias($model);

        $this->summary = $this->translator->has($key = "model-editor.$this->alias._summary")
            ? $this->translator->get($key)
            : $this->aura->summary;

        $this->description = $this->translator->has($key = "model-editor.$this->alias._description")
            ? $this->translator->get($key)
            : $this->aura->description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.form');
    }

    protected static function resolveAlias(Model $model): string
    {
        return Reflector::getClassAttribute($model, Alias::class)->alias ?? static::guessAlias($model);
    }

    protected static function guessAlias(Model $model): string
    {
        return (string) str(get_class($model))->whenStartsWith(
            $namespace = app()->getNamespace().'Models\\',
            static fn (Stringable $class) => $class->after($namespace)->replace('\\', '')->snake(),
            static fn () => throw new InvalidArgumentException('Model alias cannot be determined.')
        );
    }
}
