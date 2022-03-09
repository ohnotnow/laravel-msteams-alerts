# Quickly send a message to MS Teams

This package can quickly send alerts to Microsoft Teams. You can use this to notify yourself of any noteworthy events happening in your Laravel app.  This is a fork of Spatie's [laravel-slack-alerts](https://github.com/spatie/laravel-slack-alerts) so all thanks to them for doing the main bulk of the work.  I've pretty much just changed 'Slack' to 'MSTeams'.

```php
use Ohffs\MSTeamsAlerts\Facades\MSTeamsAlert;

MSTeamsAlert::message("You have a new subscriber to the {$newsletter->name} newsletter!");
```

Under the hood, a job is used to communicate with MS Teams. This prevents your app from failing in case Teams is down.

Want to send alerts to Discord or Slack instead? Check out [laravel-discord-alerts](https://github.com/spatie/laravel-discord-alerts) and [laravel-slack-alerts](https://github.com/spatie/laravel-slack-alerts).

## Installation

You can install the package via composer:

```bash
composer require ohffs/laravel-msteams-alerts
```

You can set a `MSTEAMS_ALERT_WEBHOOK` env variable containing a valid Teams webhook URL. You can learn how to get a webhook URL [in the Teams docs](https://docs.microsoft.com/en-us/microsoftteams/platform/webhooks-and-connectors/how-to/add-incoming-webhook).


Alternatively, you can publish the config file with:

```bash
php artisan vendor:publish --tag="msteams-alerts-config"
```

This is the contents of the published config file:

```php
return [
    /*
     * The webhook URLs that we'll use to send a message to Teams.
     */
    'webhook_urls' => [
        'default' => env('MSTEAMS_ALERT_WEBHOOK'),
    ],

    /*
     * This job will send the message to Teams. You can extend this
     * job to set timeouts, retries, etc...
     */
    'job' => Ohffs\MSTeamsAlerts\Jobs\SendToMSTeamsChannelJob::class,
];

```

## Usage

To send a message to Teams, simply call `MSTeamsAlert::message()` and pass it any message you want.

```php
MSTeamsAlert::message("You have a new subscriber to the {$newsletter->name} newsletter!");
```

## Using multiple webhooks

You can also use an alternative webhook, by specify extra ones in the config file.

```php
// in config/msteams-alerts.php

'webhook_urls' => [
    'default' => 'https://hooks.office.com/services/XXXXXX',
    'marketing' => 'https://hooks.office.com/services/YYYYYY',
],
```

The webhook to be used can be chosen using the `to` function.

```php
use Ohffs\MSTeamsAlerts\Facades\MSTeamsAlert;

MSTeamsAlert::to('marketing')->message("You have a new subscriber to the {$newsletter->name} newsletter!");
```

### Using a custom webhooks

The `to` function also supports custom webhook urls.

```php
use Ohffs\MSTeamsAlerts\Facades\MSTeamsAlert;

MSTeamsAlert::to('https://custom-url.com')->message("You have a new subscriber to the {$newsletter->name} newsletter!");
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- Ohffs
- [Niels Vanpachtenbeke](https://github.com/Nielsvanpach)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
