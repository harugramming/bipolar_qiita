@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
  @guest
  <div class="welcome">
    <div class="welcome-inner">
        <h1 class="welcome-inner-main">双極性障害の歩き方</h1>
        <p class="welcome-inner-discription">bipolarTipsは双極性障害の方が、知識を共有するためのサービスです。調子の波を乗りこなすための、あなたの気づきを共有しましょう。</p>
    </div>
  </div>
  @endguest
  <div id="main-container">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-expanded="true">新着</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="profile">ランキング</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="profile">トレンド</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">
            <div class="tab-pane-header">
              <p class="lead">
                <div class="articles_cards_list">
                    @foreach($articles as $article)
                    @include('articles.card')
                    @endforeach
                </div>
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
            <div class="tab-pane-header">
              <p class="lead">
                <div>
                    @foreach($articles_ranking as $article)
                    @include('articles.card')
                    @endforeach
                </div>
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
            <div class="tab-pane-header">
              <p class="lead">
                <div>
                    @foreach($articles_trend as $article)
                    @include('articles.card')
                    @endforeach
                </div>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container -->
</div>
</div>
　<div class="list-btn">
    <button>もっと見る</button>
　</div>
<form action="{{ asset('payment') }}" method="POST" class="text-center mt-5">
    {{ csrf_field() }}
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="1000"
        data-name="Stripe Demo"
        data-label="決済をする"
        data-description="これはStripeのデモです。"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="JPY">
    </script>
</form>
@include('articles.footer')
@endsection
