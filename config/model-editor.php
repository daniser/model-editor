<?php

return [

    'property_parser' => env('ME_PROPERTY_PARSER', 'phpstan'),

    'property_handlers' => [
        TTBooking\ModelEditor\Handlers\BooleanHandler::class,
        TTBooking\ModelEditor\Handlers\IntegerHandler::class,
        TTBooking\ModelEditor\Handlers\FloatHandler::class,
        TTBooking\ModelEditor\Handlers\StringHandler::class,
        TTBooking\ModelEditor\Handlers\EnumHandler::class,
        TTBooking\ModelEditor\Handlers\ColorHandler::class,
        TTBooking\ModelEditor\Handlers\ImageHandler::class,
        TTBooking\ModelEditor\Handlers\FileHandler::class,
    ],

    'file' => [
        'disk' => env('ME_DISK'),
        'static_disk' => env('ME_STATIC_DISK', env('ME_DISK')),
        'content_disposition' => env('ME_CONTENT_DISPOSITION', 'attachment'),
        'show_uploaded_name' => env('ME_SHOW_FILENAME', true),
    ],

    'preview' => [
        'width' => env('ME_PREVIEW_WIDTH', 100),
        'height' => env('ME_PREVIEW_HEIGHT', 100),
        'scale_down_threshold' => env('ME_PREVIEW_SCALE_DOWN_THRESHOLD', 10_240),
    ],

];
