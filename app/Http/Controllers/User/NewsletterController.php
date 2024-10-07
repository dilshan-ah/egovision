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
        $subscriber = Subscriber::where('email',Auth::user()->email)->first();

        $subscriber->delete();

        return redirect()->back();
    }
}
