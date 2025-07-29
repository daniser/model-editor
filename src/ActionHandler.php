<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\HandlerFactory;
use TTBooking\ModelEditor\Contracts\PropertyParser;

class ActionHandler implements Contracts\ActionHandler
{
    public function __construct(protected PropertyParser $parser, protected HandlerFactory $handler) {}

    public function update(Request $request, object $object): object
    {
        $aura = $this->parser->parse($object);

        foreach ($aura->properties as $property) {
            $this->handler->for($property)->handle($object, $request);
        }

        return $object;
    }
}
