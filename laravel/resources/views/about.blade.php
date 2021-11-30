@extends('app')

@section('title', 'bipolarTips - 双極向け知識共有サービス')

@section('content')
@include('nav')
<div class="welcome">
    <div class="welcome-inner">
        <h1 class="welcome-inner-main">双極性障害の歩き方</h1>
        <p class="welcome-inner-discription">bipolarTipsは双極性障害の方が、知識を共有するためのサービスです。調子の波を乗りこなすための、あなたの気づきを共有しましょう。</p>
    </div>
  </div>
  <div class="about">
    <div class="about-container">
        <h1>bipolarTipsとは</h1>
        <hr>
            <p>bipolarTipsは双極性障害の方が、知識を共有するためのサービスです。</p>
            <p>双極性障害では、ハイテンションで活動的な躁状態と、憂うつで無気力なうつ状態を繰り返します。</p>
            <p>気分の変動が大きく、日常生活を送るために症状を上手くコントロールする必要があります。</p>
            <p>症状を上手くコントロールするための療法や心構え、また利用できる社会制度などの知識をみんなが共有できる状態にしたい。</p>
            <p>それによって、双極性障害の方の幸せで健康的な生活を実現したい。そんな想いで開発をしたのがbipolarTipsです。</p>
        <h1>開発者プロフィール</h1>
        <hr>
            <p>ぱるむ / はるぐらみんぐ</p>
            <p>・25さい</p>
            <p>・大阪</p>
            <p>・双極性障害</p>
        <h1>総ユーザ数</h1>
        <hr>
            <p>{{ $users_count }}</p>
        <h1>総記事数</h1>
        <hr>
            <p>{{ $articles_count }}</p>
    </div>
  </div>
@include('articles.footer')
@endsection
