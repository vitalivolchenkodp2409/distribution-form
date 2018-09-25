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
        //dd($socialProviders);
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

   /* public function loginWithRedditCallback($provider)
    {
        //dd($provider);
        //$user = Socialite::driver($provider)->redirectUrl('http://localhost:8000/home/reddit/reddit/callback')->user();
        //$user = Socialite::driver($provider)->user();
        $user = request();
        dd($user);
        $provider_id = $user->id;

        $user = Auth::user();
        $user_id = $user->id;

        $user->socialProviders()->create(
            ['provider_id'  => $provider_id,
                'provider'  => $provider,
                'user_id'   => $user_id,
            ]
        );
        return redirect()->back();
    }*/

    public function unlinkReddit(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $socialProvider = SocialProvider::where('user_id', $user_id)->get();

        $reddit = $socialProvider[1];
        $count = 0;
        foreach ($socialProvider as $provider){
            if($provider['provider'] == 'reddit'){

                $reddit = $socialProvider[$count];
            }
            $count +=1;
        }
        if($reddit){
            $reddit->delete();

            if ($request) {
                $arrows = $user->arrows;
                if ($arrows > 0) {
                    $user->arrows -= 1;
                }
                //dd($arrows);
                //$socialProvider->delete();
            }
        }
        return redirect()->route('reddpage');
    }

}