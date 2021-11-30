@extends('app')

@section('title', 'ユーザー登録 - bipolarTips - 双極性障害向け知識共有サービス')

@section('content')
  <div class="register-container" style="background-color: #fff;">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="">
          <div class="card-body text-center">
              <h1>bipolarTips</h1>
              <p style="margin-top:10px;">新規登録(無料)をして利用を開始しましょう。</p>
              <hr>
              <form class="btn btn-twitter-inverse btn-block btn-lg" method="get" action="auth/login/twitter" style="padding:0;"><button type="submit" style="color:#fff; width:100%; padding: 14px;
                font-size: 18px;"><i class="fab fa-twitter" style="    margin-right: 4px;"></i></i>Twitterアカウントで登録</button><input type="hidden" name="authenticity_token" value="sm5m2kAP4Q99QQu9ljhuL3Ifpu9EtVNhs83Gno153GrMIDWRjxaYXKYlz4m3B+yyfSI7TW0CoYsPWXaLwZ9Lqg=="></form>
                <a href="/login/google" class="btn btn-secondary btn-lg btn-block btn-lg waves-effect waves-light" style="background-color: #c6594b !important;
                border-color: #a94335; margin-top: 10px;"role="button"><i class="fab fa-google" style="margin-right: 4px;"></i>Googleアカウントで登録<input type="hidden" name="authenticity_token" value="MgbnjeB9Q8LwLXbwBje7QWrl9vZ64vd2oJ5k2pJVWwhMSLTGL2Q6kStJssQnCDncZdhrVFNVBZwcCtTP3rPMyA=="></a>
            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="">
                  <label for="name">ユーザーID</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                  <small>英数字3〜16文字(登録後の変更はできません)</small>
                </div>
                <div class="">
                  <label for="nickname">ユーザー名（表示名）</label>
                  <input class="form-control" type="text" id="nickname" name="nickname" required value="{{ old('nickname') }}">
                </div>
                <div class="">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" >
                </div>
                <div class="">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <div class="">
                  <label for="password_confirmation">パスワード(確認)</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group"><input id="terms" required="required" style="margin-right: 4px;" type="checkbox"><label for="terms"><a href="terms" target="_blank">利用規約</a>に同意する</label></div>
                <div class="form-group"><input id="privacy" required="required" style="margin-right: 4px;" type="checkbox"><label for="privacy"><a href="/privacypolicy" target="_blank">プライバシーポリシー</a>に同意する</label></div>
                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
              </form>
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
