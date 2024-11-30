<?php

namespace App\Utils;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    private $instanceId;
    private $token;

    public function __construct()
    {
        $this->instanceId = env("ULTRAMSG_INSTANCE_ID");
        $this->token = env("ULTRAMSG_TOKEN");
    }


    public function sendMessage($phone, $message)
    {

        $url = "https://api.ultramsg.com/{$this->instanceId}/messages/chat";

        $response = Http::asForm()->post($url, [
            'token' => $this->token,
            'to' => $phone,
            'body' => $message,
        ]);

        if ($response->successful()) {
            return [
                "success" => true,
                "message" => "Mensaje enviado correctamente"
            ];
        }

        return [
            "success" => false,
            "message" => $response->body()
        ];
    }
}