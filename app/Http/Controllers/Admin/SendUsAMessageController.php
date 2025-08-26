<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SendUsAMessage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SendUsAMessageController extends Controller
{
    public function index()
    {
        $messages = SendUsAMessage::latest()->get();
        return view('admin.layouts.pages.send-us-a-message.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        SendUsAMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('message', 'Thanks for your message!');
    }

    public function destroy($id)
    {
        $message = SendUsAMessage::find($id);
        $message->delete();
        return redirect()->route('sendus.index')->with('success', 'Message deleted.');
    }
}
