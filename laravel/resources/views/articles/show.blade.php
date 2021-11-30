@extends('app')

@section('title', '記事詳細')

@section('content')
<nav class="navbar navbar-expand navbar-dark">
    <a class="navbar-brand" href="/">bipolarTips</a>
    <ul class="navbar-nav ml-auto">
    　@guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      @endguest
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
      </li>
      @endauth
      @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button"
          onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
            マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>
      <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
      </form>
      <!-- Dropdown -->
      @endauth
    </ul>
  </nav>

  <div class="container">
    @include('articles.detail')

    <div class="comment-container">
    <h1>コメント</h1>
    <hr>
    @for($i = 0; $i < count($comments); $i++)
    <div class="comments">
        <div class="comment-container-profiles">
            @if(strpos($comments[$i]->profile_image,'http:') !== false)
            <img src="{{ $comments[$i]->profile_image }}" style="width:70px;">
            @else
            <img src="{{ asset('storage/profiles/'.$comments[$i]->profile_image) }}" alt="プロフィール画像" style="width:70px;">
            @endif
            <a href="{{ route('users.show', ['name' => $comments[$i]->name]) }}" class="text-dark" >
            {{ $comments[$i]->nickname }}
            @
            {{ $comments[$i]->name }}
            </a>
        </div>
        {{ $comments[$i]->comment }}
        <br>
    </div>
    <hr>
    @endfor
    <form method="POST" action="{{ route('articles.post_comment', ['article' => $article] ) }}">
    @csrf
    <h1>投稿する</h1>
    <hr>
    <div class="form-group">
        <label></label>
        <textarea name="comment" required class="form-control" rows="8" placeholder="コメント"></textarea>
    </div>
    <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
    </form>
    </div>
  </div>
@endsection
