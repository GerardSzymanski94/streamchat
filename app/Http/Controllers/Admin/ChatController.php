<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChatEvent;
use App\Http\Controllers\Admin\BaseController;
use App\Models\ChatHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    public function chat()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        $user = User::find(Auth::id());
        $this->saveToSession($request,$user);
        event(new ChatEvent($request->message, $user));
    }

    public function saveToSession(Request $request, $user)
    {
        //dd($request);

        if(!is_null($request->message)){
            ChatHistory::create([
                'messages' => $request->message,
                'color' => $request->color,
                'user' => $user->name,
                'time' => $request->time,
            ]);

        }

        //session()->put('chat', $request->chat);
    }

    public function getOldMessages()
    {
        $chatHistories = ChatHistory::all();
        $data = [];
        $data['message'] = [];
        $data['user'] = [];
        $data['color'] = [];
        $data['time'] = [];

        foreach ($chatHistories as $chatHistory) {
            if (!is_null($chatHistory['messages'])) {
                $data['message'][] = $chatHistory['messages'];
                $data['user'][] = $chatHistory['user'];
                $data['color'][] = $chatHistory['color'];
                $data['time'][] = $chatHistory['time'];
            }
        }

        return $data;
    }

    public function getOldMessagesTest()
    {
        $chatHistories = ChatHistory::all();
        $data = [];
        $data['message'] = [];
        $data['user'] = [];
        $data['color'] = [];
        $data['time'] = [];

        foreach ($chatHistories as $chatHistory) {
            if (!is_null($chatHistory['messages'])) {
                $data['message'][] = $chatHistory['messages'];
                $data['user'][] = $chatHistory['user'];
                $data['color'][] = $chatHistory['color'];
                $data['time'][] = $chatHistory['time'];
            }
        }
        dd($data);
        dd(session('chat'));
    }
}
