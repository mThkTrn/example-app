<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

public function processGoogleCallback()
{
    try {
        $socialUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            ['name' => $socialUser->getName()]
        );
        Auth::login($user);
        return redirect('/nova');
    } catch (\Exception $e) {
        return redirect()->route('logincustom')->withErrors(['email' => 'Unable to login']);
    }
}
}

?>