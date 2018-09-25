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

class SnapchatController extends Controller
{

    protected $provider = 'snapchat';
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
            $data = ['mess' => 'Snapchat is confirmed', 'provider' => $provider];
            return view('snapchat',compact('data'));

        } else {
            $data = [];
            return view('snapchat',compact('data'));
        }
    }


}