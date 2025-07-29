<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Intervention\Image\Laravel\Facades\Image as InterventionImage;
use TTBooking\ModelEditor\Entities\AuraProperty;

class Image extends Component
{
    public object $object;

    public ?string $preview = null;

    /**
     * Create a new component instance.
     */
    public function __construct(public AuraProperty $property)
    {
        $this->object = $this->factory()->getConsumableComponentData('object'); // @phpstan-ignore assign.propertyType

        $path = (string) $this->object->{$this->property->variableName};
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
