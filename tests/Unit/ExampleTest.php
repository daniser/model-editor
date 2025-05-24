<?php

use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Facades\PropertyParser;

/**
 * Hello World!
 *
 * This is a description.
 */
class ExampleTest {}

beforeEach(function () {
    test()->aura = PropertyParser::driver('phpdoc')->parse(ExampleTest::class);
});

test('example', function () {
    expect(test()->aura)->toBeInstanceOf(Aura::class)
        ->and(test()->aura->summary)->toBe('Hello World!')
        ->and(test()->aura->description)->toBe('This is a description.');
});
