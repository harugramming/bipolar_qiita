@extends('app')

@section('title', 'bipolarTips - 双極性障害向け知識共有サービス')

@section('content')
@include('nav')
<div class="welcome">
    <div class="welcome-inner">
        <h1 class="welcome-inner-main">双極性障害の歩き方</h1>
        <p class="welcome-inner-discription">bipolarTipsは双極性障害の方が、知識を共有するためのサービスです。調子の波を乗りこなすための、あなたの気づきを共有しましょう。</p>
    </div>
</div>
<div class="wrapHINAGATA">
    <h1>連絡先</h1>
    <h2>e-mail: haruuchi.pool.0219@gmail.com</h2>
    <h2>twitter: @bipolarTips2022<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp @haru_programm</h2>

    <p></p>
</div>
@include('articles.footer')
@endsection
