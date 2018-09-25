<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\RedditController;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException as FacebookExceptionsFacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookExceptionsFacebookSDKException;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Auth;
use Socialite;
use SocialiteProviders\Reddit\Provider as Reddit;
use App\User;
use Illuminate\Http\Request;
use Session;
use App\SocialProvider;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','redirectToProvider','handleProviderCallback']);
        //$this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     *
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }*/

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {

        if($provider == 'facebook') {
            $res = Socialite::driver($provider)->scopes(['email', 'user_photos', 'user_friends'])->redirect();
            //dd('From '.$provider,$res);
            return $res;
        } else {
            $res = Socialite::with($provider)->redirect();
            //dd('From '.$provider,$res);
            return $res;
        }

    }

    /*public function redirectProvider($provider)
    {
        //dd('fdghdfuh');
        return Socialite::driver($provider)->scopes(['email', 'user_photos', 'user_friends'])->redirect();
    }*/
    /**
     * Obtain the user information from google.
     *
     * @return Response
     *
    public function handleProviderCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/')->to('/');
        }

        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'gmail.com'){
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
            if ($existingUser->type == null) {
                return redirect()->to('/select-type');
            }

        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->avatar          = $user->avatar;
            $newUser->password        = bcrypt(rand(100000,100000000));
            $newUser->ip              = $request->ip();
            $newUser->save();
            auth()->login($newUser, true);

            Mail::to($user->email)->send(new Welcome());
            return redirect()->to('/select-type');
        }
        return redirect()->to('/home');
    }*/

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $avatar = $user->getAvatar();
        //dd($user);
        /////reddit not callback email
        $authUser = User::where('email', $user->email)->first();

        if($authUser){
            Auth::login($authUser, true);
            Mail::to($user->email)->send(new Welcome());
            return redirect($this->redirectTo);
        } else {
            //dd($provider, \request()->all());
            //check who provider
            if($provider == 'facebook') {

                $fb = new Facebook([
                    'app_id' => '2163585000549245',
                    'app_secret' => '9a4dcff54a6c4bc8b50c3cbc8453a556',
                    'default_graph_version' => 'v3.1',
                ]);

                try {

                    $response = $fb->get('/' . $user->id . '/friends', $user->token);

                } catch (FacebookExceptionsFacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch (FacebookExceptionsFacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }

                $total_count = $response->getDecodedBody()['summary']['total_count'];
                //dd($response->getDecodedBody());
                if ($total_count > 0) {
                    $arrows = 3;
                    Session::put('provider', $provider);
                    Session::put('provider_id', $user->id);
                    Session::put('provider_token', $user->token);
                    Session::put('avatar', $avatar);
                    Session::put('arrows', $arrows);
                    $data = ['email' => $user->getEmail(), 'register' => true];


                    return view('welcome', compact('data'));

                } else {
                    $data = ['register' => true, 'message' => "You have less than 100 friends in $provider, please register regularly!!"];
                    return view('welcome', compact('data'));
                }

            } elseif($provider == 'reddit') {

                if(auth()->user()){

                    $provider_id = $user->id;

                    $user = Auth::user();
                    $user_id = $user->id;

                    $user->socialProviders()->create(
                        ['provider_id'  => $provider_id,
                            'provider'  => $provider,
                            'user_id'   => $user_id,
                        ]
                    );
                    return redirect()->route('reddpage');
                }

              /*  $socialProv = $user->socialProviders->where('provider_id', $provider_id)->first();
                dd($socialProv);
                if($socialProv){
                    Auth::login($authUser, true);
                    Mail::to($user->email)->send(new Welcome());
                    return redirect($this->redirectTo);
                }*/

                $comments_karma = $user->user['comment_karma'];
                $arrows = floor($comments_karma/100);
                $id = $user->id;

                    Session::put('provider', $provider);
                    Session::put('provider_id', $user->id);
                    Session::put('avatar', $avatar);
                    Session::put('arrows', $arrows);

                    $data = ['register' => true, 'message' => "A user earns 1 Arrow per 100 reddit-comment-karma , max 30 Arrow!!"];
                    return view('welcome', compact('data'));


            }
        }
    }


}

