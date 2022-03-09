<?php

namespace Ohffs\MSTeamsAlerts\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ohffs\MSTeamsAlerts\MSTeamsAlertsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            MSTeamsAlertsServiceProvider::class,
        ];
    }
}
