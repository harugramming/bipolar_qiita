@extends('app')

@section('title', 'ユーザー登録')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/">bipolarTips</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="md-form">
                  <label for="name">ユーザーID</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                  <small>英数字3〜16文字(登録後の変更はできません)</small>
                </div>
                <div class="md-form">
                  <label for="nickname">ユーザー名（表示名）</label>
                  <input class="form-control" type="text" id="nickname" name="nickname" required value="{{ old('nickname') }}">
                </div>
                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" >
                </div>
                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <div class="md-form">
                  <label for="password_confirmation">パスワード(確認)</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group"><input id="terms" required="required" style="margin-right: 4px;" type="checkbox"><label for="terms"><a href="terms" target="_blank">利用規約</a>に同意する</label></div>
                <div class="form-group"><input id="privacy" required="required" style="margin-right: 4px;" type="checkbox"><label for="privacy"><a href="/privacypolicy" target="_blank">プライバシーポリシー</a>に同意する</label></div>
                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
              </form>
              <form class="btn btn-twitter-inverse btn-block btn-lg" method="get" action="auth/login/twitter"><button type="submit"><i class="fab fa-twitter"></i></i>Twitterアカウントで登録</button><input type="hidden" name="authenticity_token" value="sm5m2kAP4Q99QQu9ljhuL3Ifpu9EtVNhs83Gno153GrMIDWRjxaYXKYlz4m3B+yyfSI7TW0CoYsPWXaLwZ9Lqg=="></form>

              <div class="mt-0">
                <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
