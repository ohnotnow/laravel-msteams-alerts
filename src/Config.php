<?php

namespace Ohffs\MSTeamsAlerts;

use Ohffs\MSTeamsAlerts\Exceptions\JobClassDoesNotExist;
use Ohffs\MSTeamsAlerts\Exceptions\WebhookUrlNotValid;
use Ohffs\MSTeamsAlerts\Jobs\SendToMSTeamsChannelJob;

class Config
{
    public static function getJob(array $arguments): SendToMSTeamsChannelJob
    {
        $jobClass = config('msteams-alerts.job');

        if (is_null($jobClass) || ! class_exists($jobClass)) {
            throw JobClassDoesNotExist::make($jobClass);
        }

        return app($jobClass, $arguments);
    }

    public static function getWebhookUrl(string $name): string|null
    {
        if (filter_var($name, FILTER_VALIDATE_URL)) {
            return $name;
        }

        $url = config("msteams-alerts.webhook_urls.{$name}");

        if (is_null($url)) {
            return null;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw WebhookUrlNotValid::make($name, $url);
        }

        return $url;
    }
}
