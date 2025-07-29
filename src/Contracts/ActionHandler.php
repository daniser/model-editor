<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Http\Request;

interface ActionHandler
{
    public function update(Request $request, object $object): object;
}
