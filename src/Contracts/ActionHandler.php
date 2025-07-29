<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Http\Request;

interface ActionHandler
{
    /**
     * @template T of object
     *
     * @param  T  $object
     * @return T
     */
    public function update(Request $request, object $object): object;
}
