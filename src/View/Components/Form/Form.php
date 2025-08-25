<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Facades\PropertyParser;
use TTBooking\ModelEditor\Types\File;

class Form extends Component
{
    public Aura $aura;

    /**
     * Create a new component instance.
     */
    public function __construct(public object $object, public bool $showDefaults = true, public ?string $enctype = null)
    {
        $this->aura = PropertyParser::parse($object);

        $containsFileProperty = collect($this->aura->properties)
            ->contains(static fn (AuraProperty $property) => $property->type->contains(File::class));

        $this->enctype ??= $containsFileProperty ? 'multipart/form-data' : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.form');
    }
}
