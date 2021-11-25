<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Auth;

class TwitterLoginController extends Controller
{
    /**
      * Twitterの認証ページヘユーザーをリダイレクト
      *
      * @return \Illuminate\Http\Response
      */
     public function redirectToProvider()
     {
         return Socialite::driver('twitter')->redirect();
     }
     /**
      * Twitterからユーザー情報を取得(Callback先)
      *
      * @return \Illuminate\Http\Response
      */
     public function handleProviderCallback()
     {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
         if(User::where('name', $twitterUser->getNickname())->exists()){
            //ツイッターで作成されたユーザーならそのままパスする
            $user = User::where('name', $twitterUser->getNickname())->first();

         }else{
            $user = new User();
            //ユーザーに必要な情報
            $user->name = $twitterUser->getNickname();
            $user->nickname = $twitterUser->getName();
            $user->email = $twitterUser->getNickname() . "@twitter.com";
            $user->password = md5(Str::uuid());
            $user->profile_image = $twitterUser->getAvatar();
            $user->save();

         }
         Log::info('Twitterから取得しました。', ['user' => $twitterUser]);
         Auth::login($user);
         return redirect('/');
     }
}
