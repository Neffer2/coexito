<?php

namespace App\Services;

class SmsService
{
    public static function sendAction($tel, $body)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.hablame.co/api/sms/v5/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "priority" => true,
                "certificate" => true,
                "campaignName" => "BullMarketing SAS",
                "from" => "BUllCRM",
                "flash" => false,
                'flash' => '0',
                'messages' => [
                    [
                        'to' => trim($tel),
                        'text' => $body,
                    ]
                ],
            ]),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                "X-Hablame-Key: " . env('SMS_TOKEN'),
                "Content-Type: application/json",
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // Puedes loguear el error si lo necesitas
        // Log::error('SMS Error: ' . $err);
        return $err ? false : true;
    }
}
