<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $client; // twilio client
    private $twilioNumber; // retrieved from .env
    private $to; // message sending to
    private $body; // body of message

    /**
     * Create a new job instance.
     *
     * @return void
     * @param $to string number to send this to
     * @param $body string message to send
     * @throws ConfigurationException
     */
    public function __construct($to, $body)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $this->twilioNumber = env('TWILIO_NUMBER');

        $this->client = new Client($accountSid, $authToken);
        $this->to = $to;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->client->messages->create(
                $this->to,
                [
                    "from" => $this->twilioNumber,
                    "body" => $this->body
                ]
            );
        } catch (TwilioException $e) {
            dd($e);
        }
    }
}
