<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use TTBooking\ModelEditor\Entities\Aura;
use TTBooking\ModelEditor\Facades\ActionHandler;
use TTBooking\ModelEditor\Facades\PropertyHandler;
use TTBooking\ModelEditor\Facades\PropertyParser;
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
            'PropertyHandler' => PropertyHandler::class,
            'ActionHandler' => ActionHandler::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
