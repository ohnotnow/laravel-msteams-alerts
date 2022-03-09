<?php

namespace Ohffs\MSTeamsAlerts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self to(string $text)
 * @method static void message(string $text)
 *
 * @see \Ohffs\MSTeamsAlerts\SlackAlert
 */
class MSTeamsAlert extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-msteams-alerts';
    }
}
