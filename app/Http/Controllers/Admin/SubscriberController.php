<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('admin.layouts.pages.subscriber.index', compact('subscribers'));
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        Toastr::success('Thank you for subscribing!');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();

        Toastr::success('Subscriber deleted successfully.');
        return redirect()->route('subscriber.index');
    }
}
