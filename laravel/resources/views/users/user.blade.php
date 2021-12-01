<div class="card mt-3 userprofile">
    <div class="card-body">
      <div class="d-flex flex-row">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            @if(strpos($user->profile_image,'http:') !== false)
            <img src="{{ $user->profile_image }}">
            @else
            <img src="data:image/png;base64,{{ $user->profile_image }}" style="width:70px;">
            @endif
        </a>
        @if( Auth::id() !== $user->id )
          <follow-button
            class="ml-auto"
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
          >
          </follow-button>
        @endif
      </div>
      <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          {{ $user->nickname}}
          @
          {{ $user->name }}
        </a>
      </h2>
      <p>総いいね数：{{ $counts_likes }}</p>
      <p>{!! $user->profile_text !!}</p>
      @if( Auth::id() == $user->id )
      <a href="{{ route('users.edit', ['name' => $user->name]) }}">プロフィールを編集</a>
      @endif
    </div>
    <div class="card-body">
      <div class="card-text">
        <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
          {{ $user->count_followings }} フォロー
        </a>
        <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
          {{ $user->count_followers }} フォロワー
        </a>
      </div>
    </div>
  </div>
