<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/');
    }

    public function createUserByGoogle($gUser)
    {
        $username = $this->makeRandStr(8);
        $user = User::create([
            'name' =>  $username,
            'nickname' => $gUser->name,
            'profile_text' => '自己紹介文です。',
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
    public function makeRandStr($length) {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
}
