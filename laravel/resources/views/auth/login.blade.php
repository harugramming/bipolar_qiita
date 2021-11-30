@extends('app')

@section('title', 'ログイン - bipolarTips - 双極性障害向け知識共有サービス')

@section('content')
  <div class="register-container" style="background-color: #fff;">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/"></a></h1>
        <div class="">
          <div class="card-body text-center">
            <h1>bipolarTips</h1>
            <p style="margin-top:10px;">ログインをして利用を開始しましょう。</p>
            <hr>
            <form class="btn btn-twitter-inverse btn-block btn-lg" method="get" action="auth/login/twitter" style="padding:0;"><button type="submit" style="color:#fff; width:100%; padding: 14px;
                font-size: 18px;"><i class="fab fa-twitter" style="    margin-right: 4px;"></i></i>Twitterアカウントで登録</button><input type="hidden" name="authenticity_token" value="sm5m2kAP4Q99QQu9ljhuL3Ifpu9EtVNhs83Gno153GrMIDWRjxaYXKYlz4m3B+yyfSI7TW0CoYsPWXaLwZ9Lqg=="></form>
                <a href="/login/google" class="btn btn-secondary btn-lg btn-block btn-lg waves-effect waves-light" style="background-color: #c6594b !important;
                border-color: #a94335; margin-top: 10px;"role="button"><i class="fab fa-google" style="margin-right: 4px;"></i>Googleアカウントで登録<input type="hidden" name="authenticity_token" value="MgbnjeB9Q8LwLXbwBje7QWrl9vZ64vd2oJ5k2pJVWwhMSLTGL2Q6kStJssQnCDncZdhrVFNVBZwcCtTP3rPMyA=="></a>
            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <div class="text-left">
                    <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ログイン</button>

              </form>

              <div class="mt-0">
                <a href="{{ route('register') }}" class="card-text">ユーザー登録はこちら</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
