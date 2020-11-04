<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChatEvent;
use App\Http\Controllers\Admin\BaseController;
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

        event(new ChatEvent($request->message, $user));
    }
    /*public function send()
    {
        $user = User::find(Auth::id());
        $message = 'test';

        event(new ChatEvent($message, $user));
    }*/
}
