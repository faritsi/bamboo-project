<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SendMessageWhatsAppService;

class MessageController extends Controller
{
    protected $whatsappService;

    public function __construct(SendMessageWhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function send(Request $request)
    {


        $validated = $request->validate([
            'target'  => 'required|string',  // The recipient's phone number
            'message' => 'required|string',  // The message content
        ]);

        try {
            $response = $this->whatsappService->sendMessage(
                $validated['target'],
                $validated['message']
            );

            return response()->json(['success' => true, 'response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
