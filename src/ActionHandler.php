<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\HandlerFactory;
use TTBooking\ModelEditor\Contracts\PropertyParser;

class ActionHandler implements Contracts\ActionHandler
{
    public function __construct(protected PropertyParser $parser, protected HandlerFactory $handler) {}

    public function update(Request $request, Model $model): Model
    {
        $aura = $this->parser->parse($model);

        foreach ($aura->properties as $property) {
            $this->handler->for($property)->handle($model, $request);
        }

        return $model;
    }
}
