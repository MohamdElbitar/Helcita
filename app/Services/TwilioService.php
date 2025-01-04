<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $whatsappNumber;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $this->whatsappNumber = env('TWILIO_WHATSAPP_NUMBER');
    }

    public function sendWhatsAppMessage($to, $message)
    {
        return $this->client->messages->create(
            "whatsapp:+201205693178", // رقم المستلم
    [
        "from" => "whatsapp:+14155238886", // رقم Twilio WhatsApp الخاص بك
        "body" => "$message"
            ]
        );
    }
}
