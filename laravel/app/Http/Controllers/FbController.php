<?php

namespace App\Http\Controllers;

use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException as FacebookExceptionsFacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookExceptionsFacebookSDKException;

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
use App\Friends;

class FbController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $socialProviders = $user->socialProviders->first();

        if($socialProviders){
            $photos = $user->photo;
            $friends = $user->friends;
            //dd($photo);
            if($photos){
                if($friends){
                    $provider = $socialProviders->provider;
                    $data = ['mark' => true, 'photos' => $photos, 'friends' =>  $friends, 'provider' => $provider ];
                    return view('facebook',compact('data'));
            }
                $provider = $socialProviders->provider;
                $data = ['mark' => true, 'photos' => $photos, 'provider' => $provider ];
                return view('facebook',compact('data'));
            }

        } else {
            //dd('aaaa');
            $data = ['mark' => false];
            return view('facebook',compact('data'));
        }
    }

    public function loginWithFb($provider)
    {
        $res = Socialite::driver($provider)->scopes([ 'email','user_photos','user_friends'])->redirectUrl('http://localhost:8000/home/facebook/facebook/callback');
        return $res->redirect();

    }

    public function loginWithFbCallback($provider)
    {
        $user = Socialite::driver($provider)->redirectUrl('http://localhost:8000/home/facebook/facebook/callback')->user();

        $fb = new Facebook([
            'app_id' => '2163585000549245',
            'app_secret' => '9a4dcff54a6c4bc8b50c3cbc8453a556',
            'default_graph_version' => 'v3.1',
        ]);

        $provider_id = $user->id;

        try {

            $response = $fb->get('/'.$provider_id.'/friends' ,$user->token );

        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = Auth::user();
        $user_id = $user->id;

        $user->socialProviders()->create(
            ['provider_id'  => $provider_id,
                'provider'  => $provider,
                'user_id'   => $user_id,
            ]
        );
        return redirect()->back();
    }

    public function unlinkFb(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $socialProvider = SocialProvider::where('user_id', $user_id)->first();
        if($socialProvider['provider'] == 'facebook') {
            $socialProvider->delete();

            if ($request) {
                $arrows = $user->arrows;
                if ($arrows > 0) {
                    $arrows -= 1;
                }
                //dd($arrows);
                $socialProvider->delete();
            }
        }
        return redirect()->back();

    }

    public function findFriends($provider)
    {
        $res = Socialite::driver($provider)->scopes([ 'email','user_photos','user_friends'])->redirectUrl('http://localhost:8000/home/facebook/friends/facebook/callback');

        return $res->redirect();

    }

    public function findFriendsCallback($provider)
    {
        $user = Socialite::driver($provider)->redirectUrl('http://localhost:8000/home/facebook/friends/facebook/callback')->user();

        $aUser = auth()->user();
        $fb = new Facebook([
            'app_id' => '2163585000549245',
            'app_secret' => '9a4dcff54a6c4bc8b50c3cbc8453a556',
            'default_graph_version' => 'v3.1',
        ]);

        $provider_id = $user->id;

        try {
            $response = $fb->get('/'.$provider_id.'/friends' ,$user->token );
            $responseFriends = $fb->get('/'.$provider_id.'/friends?fields=picture,name,context' ,$user->token );

        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $friends = $responseFriends->getDecodedBody()['data'];
        Session::put('friends', true);
        //Session::push('friends', $friends);
        Session::save();

        $count = 0;
        foreach($friends as $friend) {
            $socialProvider = SocialProvider::where('provider_id', $friend['id'])->first();
            //dd($socialProvider);
            if(isset($socialProvider)) {

                $authUser = $socialProvider->user;

                if ($authUser->arrows < 30) {
                    $authUser->arrows += 3;
                    $authUser->save();
                }
                $count += 1;
            }
            //dd($friend);
            $link_picture = $friend['picture']['data']['url'];
            $name = $friend['name'];
            $provider_id = $friend['id'];
            //dd($friend);
            $friends = Friends::where('provider_id', $provider_id)->first();

            if(!$friends){

                $friends = $aUser->friends();
                $friends->createMany([
                    [
                        'link_picture' => $link_picture,
                        'name'  => $name,
                        'provider_id' => $provider_id,
                    ],
                ]);
            }
        }

            if($aUser->arrows < 30) {
                $aUser->arrows += $count * 3;
                $aUser->save();
            }
        //return redirect()->route('fbpage')->with('friends', $friends);
        return redirect()->route('fbpage');

    }

    public function friendsLock(Request $request)
    {
        $user = Auth::user();

        if($request){
           if(Session::has('friends')){
               Session::forget('friends');
               Session::save();
           $arrows = $user->arrows;
               if( $arrows > 0){
                   $user->arrows -= 1;
                   $user->save();
               }
           }
        }
        return redirect()->route('fbpage');
    }

    public function getPhotos($provider)
    {
        $res = Socialite::driver($provider)->scopes([ 'email','user_photos','user_friends'])->redirectUrl('http://localhost:8000/home/facebook/photos/facebook/callback');
        return $res->redirect();
    }

    public function getPhotosCallback($provider)
    {
        $user = Socialite::driver($provider)->redirectUrl('http://localhost:8000/home/facebook/photos/facebook/callback')->user();

        $fb = new Facebook([
            'app_id' => '2163585000549245',
            'app_secret' => '9a4dcff54a6c4bc8b50c3cbc8453a556',
            'default_graph_version' => 'v3.1',
        ]);

        $provider_id = $user->id;

        try {
            $response = $fb->get('/'.$provider_id.'/friends' ,$user->token );
            $responsePhotos = $fb->get('/'.$user->id.'/photos?limit=16&type=uploaded&fields=link,images' ,$user->token );

        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $fotos = $responsePhotos->getDecodedBody()['data'];

        Session::put('fotos', true);
        //Session::push('fotos', $fotos);
        Session::save();

        $user = Auth::user();
        $user->karma +=3;
        $user->save();
        //save link fotos in db table photos
        foreach($fotos as $foto) {
            $link_foto = $foto['images'][0]['source'];

            $photki = Photo::where('link_photo', $link_foto)->first();
            //dd($photki);
            if(!$photki){
                //dd('aaaaaaa');
                $photos = $user->photo();
                $photos->createMany([
                    [
                        'link_photo' => $link_foto,
                    ],
                ]);
            }
        }
        //return redirect()->back()->with('fotos', $fotos);
        return redirect()->route('fbpage');

    }

    public function lockPhotos(Request $request)
    {
        $user = Auth::user();

        if($request){

            if(Session::has('fotos')){
                Session::forget('fotos');
                Session::save();
                $karma = $user->karma;
                if( $karma > 0){
                    $user->karma -= 1;
                    $user->save();
                }
            }
        }
        return redirect()->back();
    }

    public function likeFbPage(Request $request)
    {
        $user = Auth::user();

        if($request){
            $user->arrows += 1;
            $user->save();
        }
        return redirect()->to('https://www.facebook.com/projectoblio');

    }


}