<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use TTBooking\ModelEditor\Entities\AuraProperty;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Model $model, public AuraProperty $property) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<input type="checkbox" name="{{ $property->variableName }}" @checked($model->{$property->variableName}) @disabled(! $property->writable) />
blade;
    }
}
