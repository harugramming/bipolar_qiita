@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <div class="container">
        <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype='multipart/form-data'>
            @csrf
        <div class="md-form">
            <label for="nickname">ユーザー名（表示名）</label>
            <input class="form-control" type="text" id="nickname" name="nickname" required value="{{ $user->nickname}}">
        </div>
        <div>
            <input type="file" name="image">
        </div>
        <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">更新する</button>
        </form>
    </div>
      <!-- /.container -->
  </div>
@endsection
