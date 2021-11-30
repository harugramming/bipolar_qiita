@extends('app')

@section('title', $user->name . 'のいいねした記事 - bipolarTips - 双極向け知識共有サービス')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => true])
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection
