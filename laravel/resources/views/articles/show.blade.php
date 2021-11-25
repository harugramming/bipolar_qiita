@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.detail')
    @for($i = 0; $i < count($comments); $i++)
    @if(strpos($comments[$i]->profile_image,'http:') !== false)
    <img src="{{ $comments[$i]->profile_image }}">
    @else
    <img src="{{ asset('storage/profiles/'.$comments[$i]->profile_image) }}" alt="プロフィール画像">
    @endif
    {{ $comments[$i]->name }}
    {{ $comments[$i]->comment }}
    <br>
    @endfor
    <form method="POST" action="{{ route('articles.post_comment', ['article' => $article] ) }}">
    @csrf
    <div class="form-group">
        <label></label>
        <textarea name="comment" required class="form-control" rows="8" placeholder="コメント"></textarea>
    </div>
    <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
    </form>
  </div>
@endsection
