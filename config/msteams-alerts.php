<?php

return [
    /*
     * The webhook URLs that we'll use to send a message to Slack.
     */
    'webhook_urls' => [
        'default' => env('MSTEAMS_ALERT_WEBHOOK'),
    ],

    /*
     * This job will send the message to Slack. You can extend this
     * job to set timeouts, retries, etc...
     */
    'job' => Ohffs\MSTeamsAlerts\Jobs\SendToMSTeamsChannelJob::class,
];