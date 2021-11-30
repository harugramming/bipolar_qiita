@extends('app')

@section('title', $user->name . ' bipolarTips - 双極性障害向け知識共有サービス')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <div class="container">
        <form id="profile_update_form"method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype='multipart/form-data'>
            @csrf
        <div class="md-form">
            <label for="nickname">ユーザー名（表示名）</label>
            <input class="form-control" type="text" id="nickname" name="nickname" required value="{{ $user->nickname}}">
        </div>
        <div>
            <input type="file" name="image">
        </div>
        <div class="md-form">
            <label for="profile_text">自己紹介文</label>
            <textarea maxlength="512" class="form-control" type="text" id="profile_text" name="profile_text" required>{{ $user->profile_text }}
            </textarea>
        </div>
        <button class="btn btn-block blue-gradient mt-2 mb-2" id="profile_update_button"type="button">更新する</button>
        </form>
    </div>
      <!-- /.container -->
  </div>
@endsection
