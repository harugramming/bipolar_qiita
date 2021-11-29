@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="welcome">
    <div class="welcome-inner">
        <h1 class="welcome-inner-main">双極性障害の歩き方</h1>
        <p class="welcome-inner-discription">bipolarTipsは双極性障害の方が、知識を共有するためのサービスです。調子の波を乗りこなすための、あなたの気づきを共有しましょう。</p>
    </div>
  </div>
@include('articles.footer')
@endsection
