<?php

use Illuminate\Support\Facades\Bus;
use Ohffs\MSTeamsAlerts\Exceptions\JobClassDoesNotExist;
use Ohffs\MSTeamsAlerts\Exceptions\WebhookUrlNotValid;
use Ohffs\MSTeamsAlerts\Facades\MSTeamsAlert;
use Ohffs\MSTeamsAlerts\Jobs\SendToMSTeamsChannelJob;

beforeEach(function () {
    Bus::fake();
});

it('can dispatch a job to send a message to msteams using the default webhook url', function () {
    config()->set('msteams-alerts.webhook_urls.default', 'https://test-domain.com');

    MSTeamsAlert::message('test-data');

    Bus::assertDispatched(SendToMSTeamsChannelJob::class);
});

it('can dispatch a job to send a message to msteams using an alternative webhook url', function () {
    config()->set('msteams-alerts.webhook_urls.marketing', 'https://test-domain.com');

    MSTeamsAlert::to('marketing')->message('test-data');

    Bus::assertDispatched(SendToMSTeamsChannelJob::class);
});

it('will throw an exception for a non existing job class', function () {
    config()->set('msteams-alerts.webhook_urls.default', 'https://test-domain.com');
    config()->set('msteams-alerts.job', 'non-existing-job');

    MSTeamsAlert::message('test-data');
})->throws(JobClassDoesNotExist::class);


it('will throw an exception for an invalid webhook url', function () {
    config()->set('msteams-alerts.webhook_urls.default', '');

    MSTeamsAlert::message('test-data');
})->throws(WebhookUrlNotValid::class);

it('will throw an exception for an invalid job class', function () {
    config()->set('msteams-alerts.webhook_urls.default', 'https://test-domain.com');
    config()->set('msteams-alerts.job', '');

    MSTeamsAlert::message('test-data');
})->throws(JobClassDoesNotExist::class);

it('will throw an exception for a missing job class', function () {
    config()->set('msteams-alerts.webhook_urls.default', 'https://test-domain.com');
    config()->set('msteams-alerts.job', null);

    MSTeamsAlert::message('test-data');
})->throws(JobClassDoesNotExist::class);
