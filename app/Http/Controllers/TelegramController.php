<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        // dd($activity);
    }

    public function sendEmailTelegram(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $text = "Có người muốn liên hệ bạn qua Email này: " . $validated['email'];

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
 
        toastr()->success('Gửi email thành công');
        return redirect()->back();
    }
}
