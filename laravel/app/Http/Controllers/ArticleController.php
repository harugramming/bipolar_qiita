<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Comment;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');
        $articles_ranking = Article::withcount('likes')->orderBy('likes_count', 'desc')->get();

        return view('articles.index', ['articles' => $articles, 'articles_ranking' => $articles_ranking]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        $comment = \App\Comment::join('users', 'users.id', '=', 'comments.user_id')->where('article_id', $article->id)->get();
        return view('articles.show', ['article' => $article, 'comments' => $comment]);
    }

    public function post_comment(Request $request, Article $article)
    {
        $comment = new Comment();
        $comment->fill(['user_id' => Auth::id(), 'article_id' => $article->id, 'comment' => $request->comment]);
        $comment->save();

        $comment = \App\Comment::join('users', 'users.id', '=', 'comments.user_id')->where('article_id', $article->id)->get();
        return view('articles.show', ['article' => $article, 'comments' => $comment]);
    }
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
