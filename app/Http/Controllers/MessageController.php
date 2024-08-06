<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id)
    {
        $messages = UserMessage::where(function ($query) use ($id) {
            $query->where('receiver_id', Auth::id())
                ->where('user_id', $id);
        })
            ->orWhere(function ($query) use($id) {
                $query->where('user_id', Auth::id())
                    ->where('receiver_id', $id);
            })
            ->get();
        $chatMate = \App\Models\User::find($id);
        return view('dashboard' , ['messages' => $messages, 'chatMate' => $chatMate]);
    }
}
