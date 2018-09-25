<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialProvider;
use Auth;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session;

class UsersController extends Controller
{

    public function store(Request $request)
    {
        //dd('aaaaaaa');
        $request->validate([
            //'email' => 'required|unique:users',
            'email' => 'required',
            'name' => 'required',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $arrows = null;

        if (Session::has('provider') && Session::has('provider_id')) {
            $provider = Session::get('provider');
            $avatar = Session::get('avatar');
            /*if($provider == 'facebook') {
                $arrows = 3;
            } else {
                $arrows = Session::get('arrows');
            }*/
            $arrows = Session::get('arrows');
            $arrows = (float)$arrows;
            //dd($arrows);
            ///check isset authUser
            $authUser = User::where('email', $request->email)->first();
            if(!$authUser) {
                $user = User::create(
                    [
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'avatar' => $avatar,
                        'arrows' => $arrows,
                        'password' => bcrypt($request->input('password')),
                        'company' => $request->input('company'),
                        'contact_number' => $request->input('contact_number'),
                        'ip' => $request->ip()
                    ]);

                $user_id = $user->id;
                $provider = Session::get('provider');
                $provider_id = Session::get('provider_id');

                //create provider in db
                $socialProvider = $user->socialProviders()->create([
                    'provider' => $provider,
                    'provider_id' => $provider_id,
                ]);
                //$socialProvider = $user->socialProviders;
                //dd($socialProvider);
                Session::forget('provider');
                Session::forget('provider_id');
                Session::forget('avatar');
                Session::forget('arrows');
                //Session::forget('provider_token');
                Auth::login($user, true);
                return redirect()->to('/select-type');
            } else {
                $user_id = $authUser->id;
                $provider = Session::get('provider');
                $provider_id = Session::get('provider_id');

                //create provider in db
                $socialProvider = $authUser->socialProviders()->create([
                    'provider' => $provider,
                    'provider_id' => $provider_id,
                ]);
                //$socialProvider = $user->socialProviders;
                //dd($socialProvider);
                Session::forget('provider');
                Session::forget('provider_id');
                Session::forget('avatar');
                Session::forget('arrows');
                //Session::forget('provider_token');
                Auth::login($authUser, true);
                return redirect()->to('home');
            }

        } else {

            $user = User::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'company' => $request->input('company'),
                    'contact_number' => $request->input('contact_number'),
                    'ip' => $request->ip()
                ]);
            if ($user) {
                if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                    Mail::to($user->email)->send(new Welcome());
                    return redirect()->to('/select-type');
                }
            }

            Session::flash('success', 'New user successfully created.');
            return back();
        }
    }


}
