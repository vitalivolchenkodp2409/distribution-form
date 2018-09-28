<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Auth;
use Socialite;
use App\User;
use Illuminate\Http\Request;
use Session;
use App\SocialProvider;
use App\Photo;

class RedditController extends Controller
{

    protected $provider = 'reddit';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $user = Auth::user();
        $socialProviders = $user->socialProviders->where('provider', $this->provider)->first();
        
        if($socialProviders){
            $provider = $socialProviders->provider;
            $data = ['mess' => 'Reddit is confirmed', 'provider' => $provider];
            return view('reddit',compact('data'));

        } else {
            $data = [];
            return view('reddit',compact('data'));
        }
    }

    public function loginWithReddit($provider)
    {
        $res = Socialite::with($provider);
        return $res->redirect();
    }   

    public function unlinkReddit(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
   
        $reddit = SocialProvider::where('user_id', $user_id)->where('provider', 'reddit')->first();

        if($reddit){
            $reddit->delete();

            if ($request) {
                $arrows = $user->arrows;
                if ($arrows > 0) {
                    $user->arrows -= 1;
                }                
            }
        }
        return redirect()->route('reddpage');
    }

}