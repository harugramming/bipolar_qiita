<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Log;

 class TwitterLoginController extends Controller
 {
     /**
       * Twitterの認証ページヘユーザーをリダイレクト
       *
       * @return \Illuminate\Http\Response
       */
       public function redirectToProvider(){
          return Socialite::driver('twitter')->redirect();
       }
      /**
       * Twitterからユーザー情報を取得(Callback先)
       *
       * @return \Illuminate\Http\Response
      */
      public function handleProviderCallback()
      {
          $user = Socialite::driver('twitter')->user();
          Log::info('Twitterから取得しました。', ['user' => $user]);
          // $user->token;
      }
 }
