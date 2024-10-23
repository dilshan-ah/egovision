<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function store()
    {
        $subscriber = new Subscriber();
        $subscriber->email = Auth::user()->email;

        $subscriber->save();

        return redirect()->back();
    }

    public function delete()
    {
        $subscriber = Subscriber::where('email', Auth::user()->email)->first();

        $subscriber->delete();

        return redirect()->back();
    }

    public function storeWithEmail(Request $request)
    {
        try {
            $existsSubscriber = Subscriber::where('email', $request->email)->exists();
            if ($existsSubscriber) {
                $notify[] = ['success', 'Email already subscribed'];
                return redirect()->back()->withNotify($notify);
            } else {
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->save();

                $notify[] = ['success', 'Email subscribed successfully'];
                return redirect()->back()->withNotify($notify);
            }
        } catch (\Throwable $th) {
            $notify[] = ['error', $th];
            return redirect()->back()->withNotify($notify);
        }
    }
}
