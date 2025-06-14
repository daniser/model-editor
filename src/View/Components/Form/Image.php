<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Intervention\Image\Laravel\Facades\Image as InterventionImage;
use TTBooking\ModelEditor\Entities\AuraProperty;

class Image extends Component
{
    public Model $model;

    public ?string $preview = null;

    /**
     * Create a new component instance.
     */
    public function __construct(public AuraProperty $property)
    {
        $this->model = $this->factory()->getConsumableComponentData('model'); // @phpstan-ignore assign.propertyType

        $path = (string) $this->model->{$this->property->variableName};
        if ($path && Storage::has($path)) {
            $this->preview = InterventionImage::read(Storage::get($path))->scaleDown(100, 100)->encode()->toDataUri();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.image');
    }
}
