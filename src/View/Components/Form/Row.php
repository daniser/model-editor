<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use TTBooking\ModelEditor\Entities\AuraProperty;

use function TTBooking\ModelEditor\Support\prop_desc;

class Row extends Component
{
    public Model $model;

    public string $alias;

    public string $id;

    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(public AuraProperty $property)
    {
        $this->model = $this->factory()->getConsumableComponentData('model'); // @phpstan-ignore assign.propertyType
        $this->alias = $this->factory()->getConsumableComponentData('alias'); // @phpstan-ignore assign.propertyType

        $this->id = $this->alias.'_'.Str::snake($property->variableName);
        $this->description = prop_desc($this->model, $property->variableName, $property->description);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.row');
    }
}
