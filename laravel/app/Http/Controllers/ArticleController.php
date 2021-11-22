<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        if(Article::all()->sortByDesc('created_at')->count() >= 30){
            $articles = Article::latest('created_at')
            ->simplePaginate(30)->sortByDesc('created_at');
        }else{
            $articles = Article::all()->sortByDesc('created_at');
        }

        if(Article::withcount('likes')->orderBy('likes_count', 'desc')->count() >= 30){
            $articles_ranking = Article::withcount('likes')->orderBy('likes_count', 'desc')->simplePaginate(30);
        }else{
            $articles_ranking = Article::withcount('likes')->orderBy('likes_count', 'desc')->get();
        }

        $date = new Carbon('-1 months');
        if(Article::withcount('likes')->orderBy('likes_count', 'desc')->whereDate('created_at', '>', $date)->count() >= 30){
            $articles_trend = Article::withcount('likes')->orderBy('likes_count', 'desc')->whereDate('created_at', '>', $date)->simplePaginate(30);
        }else{
            $articles_trend = Article::withcount('likes')->orderBy('likes_count', 'desc')->whereDate('created_at', '>', $date)->get();
        }
        return view('articles.index',
        ['articles' => $articles,
        'articles_ranking' => $articles_ranking,
        'articles_trend' => $articles_trend
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $request->body = htmlspecialchars($request->body,ENT_QUOTES,'UTF-8');
        $search = array('&lt;h1&gt;','&lt;/h1&gt;',
        '&lt;h2&gt;','&lt;/h2&gt;',
        '&lt;h3&gt;','&lt;/h3&gt;',
        '&lt;p&gt;','&lt;/p&gt;',
        '&lt;em&gt;','&lt;/em&gt;',
        '&lt;ol&gt;','&lt;/ol&gt;',
        '&lt;li&gt;','&lt;/li&gt;',
        '&lt;ul&gt;','&lt;/ul&gt;',
        '&lt;img','&lt;/img&gt;',
        '&lt;a&gt;','&lt;/a&gt;',
        '&lt;b&gt;','&lt;/b&gt;',
        '&lt;u&gt;','&lt;/u&gt;',
        '&lt;strong&gt;','&lt;/strong&gt;',
     );
        $replace = array('<h1>','</h1>','<h2>','</h2>','<h3>','</h3>',
        '<p>','</p>','<em>','</em>','<ol>','</ol>','<ul>','</ul>','<li>','</li>','<img','</img>','<a>','</a>','<b>','</b>','<u>','</u>','<strong>','</strong>');
        $request->body = str_replace($search,$replace,$request->body);
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
