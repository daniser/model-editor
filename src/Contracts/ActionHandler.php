<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ActionHandler
{
    public function update(Request $request, Model $model): Model;
}
