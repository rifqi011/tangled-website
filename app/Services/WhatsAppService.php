<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp notification using Fonnte API.
     *
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function sendNotification(string $phone, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message
            ]);

            // Log the response or handle errors if needed
            if (!$response->successful()) {
                Log::error('WhatsApp notification failed', [
                    'phone' => $phone,
                    'response' => $response->body()
                ]);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('WhatsApp notification error', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
