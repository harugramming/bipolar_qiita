@extends('app')

@section('title', $user->name . ' bipolarTips - 双極向け知識共有サービス')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-expanded="true">記事</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="profile">いいね</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">
            <div class="tab-pane-header">
              <p class="lead">
                <div>
                    @foreach($articles_posts as $article)
                    @include('articles.card')
                    @endforeach
                </div>
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
            <div class="tab-pane-header">
              <p class="lead">
                @foreach($articles_likes as $article)
                @include('articles.card')
                @endforeach
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container -->
  </div>
@endsection
