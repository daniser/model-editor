<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Types;

/**
 * @template TDisk of string|null = null
 *
 * @extends File<TDisk, 'image/{*}'>
 */
class Image extends File {}
