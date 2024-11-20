<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SendMessageWhatsAppService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.fonnte.com/', // Set the API's base URL
            'timeout'  => 30.0,                     // Set a timeout
        ]);
    }

    /**
     * Send a WhatsApp message via Fonnte API
     *
     * @param string $target The recipient's phone number
     * @param string $message The message content
     * @return string Response from the API
     * @throws \Exception
     */
    public function sendMessage($target, $message)
    {
        $token = env('FONTE_TOKEN_KEY'); // Store your token in .env

        try {
            $response = $this->client->post('send', [
                'headers' => [
                    'Authorization' => $token,
                    'Accept'        => 'application/json',
                ],
                'form_params' => [
                    'target'  => $target,
                    'message' => $message,
                ],
            ]);

            return $response->getBody()->getContents(); // Return the response body
        } catch (RequestException $e) {
            $error = $e->hasResponse()
                ? $e->getResponse()->getBody()->getContents()
                : $e->getMessage();

            throw new \Exception("WhatsApp Message Sending Error: $error");
        }
    }
}
