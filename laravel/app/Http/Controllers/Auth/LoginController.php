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
use Cache;
use Artisan;

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
    }    

    public function logout(Request $request) 
    {  
        Auth::logout();
        return redirect('/');
    }
    
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {  
        if($provider == 'facebook') {

            $res = Socialite::driver($provider)->scopes(['email', 'user_photos', 'user_friends'])->redirect();            
                        
            return $res;
        } else {
            $res = Socialite::with($provider)->redirect();
            
            return $res;
        }

    }    

    public function handleProviderCallback($provider)
    {         
        
        $user = Socialite::driver($provider)->stateless()->user();        

        $avatar = $user->getAvatar();        
        /////reddit not callback email
        $authUser = User::where('email', $user->email)->first();

        if($authUser){
            Auth::login($authUser, true);
            Mail::to($user->email)->send(new Welcome());
            return redirect($this->redirectTo);
        } else {            
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
                
                if ($total_count > 100) {
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

                $provider_id = $user->id;
                $socialeProv = SocialProvider::where('provider_id', $provider_id)->first();  
                
                if(auth()->user()){ 
                    $uId = auth()->user()->id;
                    if(isset($socialeProv)){
                        if($uId != $socialeProv->user_id){
                            Session::put('res', 'This Reddit is already linked to another oblio profile');                        
                            return redirect()->route('reddpage');  
                        }  
                        $User = $socialeProv->user;
                        Auth::login($User, true);                
                        return redirect($this->redirectTo);    
                    } 
                    
                    $aUser = Auth::user();
                    $user_id = $aUser->id;

                    $aUser->socialProviders()->create(
                        ['provider_id'  => $provider_id,
                            'provider'  => $provider,
                            'user_id'   => $user_id,
                        ]
                    );
                    Session::forget('res');

                    return redirect()->route('reddpage');

                } else {

                    if(isset($socialeProv)){
                        $User = $socialeProv->user;
                        Auth::login($User, true);                
                        return redirect($this->redirectTo); 
                    }
                
                $name = $user->user['name'];                
                $comments_karma = $user->user['comment_karma'];
                $arrows = floor($comments_karma/100);
                $id = $user->id;

                    Session::put('provider', $provider);
                    Session::put('provider_id', $user->id);
                    Session::put('avatar', $avatar);
                    Session::put('arrows', $arrows);                    
                    $data = ['register' => true, 'name' => $name, 'mess' => "A user earns 1 Arrow per 100 reddit-comment-karma , max 30 Arrow!!"];
                    return view('welcome', compact('data'));

                }
            }
        }
    }


}

