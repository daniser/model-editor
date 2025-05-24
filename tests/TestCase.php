<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Facades\PropertyParser;
use TTBooking\ModelEditor\Facades\TypeHandler;
use TTBooking\ModelEditor\ModelEditorServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    public Aura $aura;

    protected function getPackageProviders($app): array
    {
        return [
            ModelEditorServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'PropertyParser' => PropertyParser::class,
            'TypeHandler' => TypeHandler::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
