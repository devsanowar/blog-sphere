<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Team;

class ChatController extends Controller
{
    public function index()
    {
        $users = Team::where('id', '!=', auth()->id())->get();
        return view('admin.layouts.pages.chat.index', compact('users'));
    }

    public function fetchMessages(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

}
