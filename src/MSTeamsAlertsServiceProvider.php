<?php

namespace Ohffs\MSTeamsAlerts;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MSTeamsAlertsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-msteams-alerts')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind('laravel-msteams-alerts', function () {
            return new MSTeamsAlert();
        });
    }
}
