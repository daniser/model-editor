<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Contracts;

use Illuminate\Database\Eloquent\Model;
use TTBooking\ModelEditor\Entities\Aura;

interface PropertyParser
{
    /**
     * @param  Model|class-string<Model>  $model
     */
    public function parse(Model|string $model): Aura;
}
