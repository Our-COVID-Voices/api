<?php

declare(strict_types=1);

namespace App\Sms;

use Twilio\Rest\Client;

class TwilioSmsSender implements SmsSender
{
    /**
     * @var \Twilio\Rest\Client
     */
    protected $client;

    /**
     * TwilioSmsSender constructor.
     *
     * @param \Twilio\Rest\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function send(string $from, string $to, string $body): void
    {
        $this->client->messages->create(
            $this->parsePhoneNumber($to),
            [
                'from' => config('sms.from'),
                'body' => $body,
            ]
        );
    }

    /**
     * @param string $to
     * @return string
     */
    protected function parsePhoneNumber(string $to): string
    {
        return '+44' . mb_substr($to, 1);
    }
}
