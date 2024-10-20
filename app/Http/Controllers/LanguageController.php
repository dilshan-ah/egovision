<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $request->validate([
            'code' => 'required|string|in:en,hi,ru,zh,bn',
        ]);

        session(['preferredLanguage' => $request->code]);

        return redirect()->back();
    }
}
