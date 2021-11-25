@extends('app')

@section('title', 'ログイン')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/">bipolarTips</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ログイン</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <div class="text-left">
                    <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ログイン</button>

              </form>
              <form class="btn btn-twitter-inverse btn-block btn-lg" method="get" action="auth/login/twitter"><button type="submit"><i class="fab fa-twitter"></i></i>Twitterアカウントで登録</button><input type="hidden" name="authenticity_token" value="sm5m2kAP4Q99QQu9ljhuL3Ifpu9EtVNhs83Gno153GrMIDWRjxaYXKYlz4m3B+yyfSI7TW0CoYsPWXaLwZ9Lqg=="></form>
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
