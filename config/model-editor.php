<?php

return [

    'property_parser' => [
        'driver' => env('ME_PP_DRIVER', 'phpstan'),
    ],

    'type_handlers' => [
        TTBooking\ModelEditor\Handlers\BooleanHandler::class,
        TTBooking\ModelEditor\Handlers\IntegerHandler::class,
        TTBooking\ModelEditor\Handlers\StringHandler::class,
    ],

];
