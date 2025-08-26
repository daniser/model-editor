<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Intervention\Image\Laravel\Facades\Image as InterventionImage;
use TTBooking\ModelEditor\Entities\AuraProperty;
use function TTBooking\ModelEditor\Support\prop_val;

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

        /** @var \TTBooking\ModelEditor\Types\Image|null $image */
        $image = prop_val($property, $this->object);
        if ($image && $image->exists()) {
            $this->preview = InterventionImage::read($image->getContent())->scaleDown(100, 100)->encode()->toDataUri();
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
