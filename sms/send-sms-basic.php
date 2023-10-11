<?php

/**
 * Send an SMS message directly by calling HTTP endpoint.
 *
 * For your convenience, environment variables are already pre-populated with your account data
 * like authentication, base URL and phone number.
 *
 * Please find detailed information in the readme file.
 */
//0b57e3323485b040fb5c43b055f7e08d-176f788a-abbf-4a95-ad20-a7c1c072ad20
require '../src/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

$dest = new Client([
    'base_uri' => "https://6j8xze.api.infobip.com/",
    'headers' => [
        'Authorization' => "App 0b57e3323485b040fb5c43b055f7e08d-176f788a-abbf-4a95-ad20-a7c1c072ad20",
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ]
]);

$response = $dest->request(
    'POST',
    'sms/2/text/advanced',
    [
        RequestOptions::JSON => [
            'messages' => [
                [
                    'from' => 'Impr NEIO',
                    'destinations' => [
                        ['to' => "213541035548"]
                    ],
                    'text' => 'This is a sample message',
                ]
            ]
        ],
    ]
);

echo("HTTP code: " . $response->getStatusCode() . PHP_EOL);
echo("Response body: " . $response->getBody()->getContents() . PHP_EOL);
