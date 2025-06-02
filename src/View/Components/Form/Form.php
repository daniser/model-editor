<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\View\Components\Form;

use Closure;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Facades\PropertyParser;
use TTBooking\ModelEditor\Support\AliasResolver;

use function TTBooking\ModelEditor\Support\prop_desc;

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
        $this->alias = AliasResolver::resolveAlias($model);

        $this->summary = prop_desc($this->alias, '_summary', $this->aura->summary);
        $this->description = prop_desc($this->alias, '_description', $this->aura->description);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('model-editor::components.form.form');
    }
}
