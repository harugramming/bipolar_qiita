@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
  @guest
  <div class="welcome blue-gradient">
    <div class="welcome-inner">
        <h1 class="welcome-inner-main">双極性障害の歩き方</h1>
        <p class="welcome-inner-discription">ばいぽらは双極性障害の方が、知識を共有するためのサービスです。調子の波を乗りこなすための、あなたの気づきを共有しましょう。</p>
    </div>
  </div>
  @endguest
  <div id="main-container">
    <div class="container">
        @foreach($articles as $article)
        @include('articles.card')
        @endforeach
    </div>
</div>

  </div>

@endsection
