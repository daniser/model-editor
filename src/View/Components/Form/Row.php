<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use TTBooking\ModelEditor\Concerns\Translatable;
use TTBooking\ModelEditor\Entities\AuraProperty;

class Row extends Component
{
    use Translatable;

    public string $alias;

    public string $id;

    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(protected Translator $translator, public AuraProperty $property)
    {
        $this->alias = $this->factory()->getConsumableComponentData('alias'); // @phpstan-ignore assign.propertyType

        $this->id = $this->alias.'_'.Str::snake($property->variableName);
        $this->description = $this->getPropertyDescription($this->alias, $property->variableName, $property->description);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.row');
    }
}
