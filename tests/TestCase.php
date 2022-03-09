<?php

namespace Ohffs\MSTeamsAlerts\Tests;

use Ohffs\MSTeamsAlerts\MSTeamsAlertsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            MSTeamsAlertsServiceProvider::class,
        ];
    }
}
