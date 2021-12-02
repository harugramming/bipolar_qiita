<div class="card mt-3 detail">
    <div class="card-body d-flex flex-row detail-profile">
      <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
        @if(strpos($article->user->profile_image,'http:') !== false)
        <img src="{{ $article->user->profile_image }}">
        @else
        <img src="data:image/png;base64,{{ $article->user->profile_image }}" style="width:70px;">
        @endif
      </a>
      <div style="margin-left:8px;">
        <div class="font-weight-bold" >
            <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                {{ $article->user->nickname}}
                @
                {{ $article->user->name }}
            </a>
        </div>
        <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
    </div>

    @if( Auth::id() === $article->user_id )
      <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                <i class="fas fa-pen mr-1"></i>記事を更新する
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                <i class="fas fa-trash-alt mr-1"></i>記事を削除する
              </a>
            </div>
          </div>
        </div>
        <!-- dropdown -->

        <!-- modal -->
        <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  {{ $article->title }}を削除します。よろしいですか？
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                  <button type="submit" class="btn btn-danger">削除する</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal -->
      @endif

    </div>
    <div class="card-body pt-0">
      <h3 class="h4 card-title">
        <h1>
            {{ $article->title }}
        </h1>
        <hr>
      </h3>
      <div class="card-text">
        {!! $article->body !!}
      </div>
    </div>
    <div class="card-body pt-0 pb-2 pl-3">
        <div class="card-text">
          <article-like
            :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($article->count_likes)'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('articles.like', ['article' => $article]) }}"
          >
          </article-like>
        </div>
      </div>
  </div>
