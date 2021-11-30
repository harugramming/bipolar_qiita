@extends('app')

@section('title', $user->name . 'のフォロワー - bipolarTips - 双極性障害向け知識共有サービス')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @foreach($followers as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection
