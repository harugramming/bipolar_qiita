<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes']);
        
        $data = $user->articles;
        $counts_likes = 0;
        foreach ($data as $d) {
            $counts_likes += \DB::table('likes')->where('article_id', $d->id)->count();
        }

        $articles_posts = $user->articles->sortByDesc('created_at');
        $articles_likes = $user->likes->sortByDesc('created_at');
        return view('users.show', [
            'user' => $user,
            'articles_posts' => $articles_posts,
            'articles_likes' => $articles_likes,
            'counts_likes' => $counts_likes,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();
        if(Auth::id() != $user->id){
            abort(403);
        }
        $data = $user->articles;
        $counts_likes = 0;
        foreach ($data as $d) {
            $counts_likes += \DB::table('likes')->where('article_id', $d->id)->count();
        }
        return  view('users.edit', [
            'user' => $user,
            'counts_likes' => $counts_likes,
        ]);
    }

    public function update(string $name, Request $request){
        $user = User::where('name', $name)->first();

        if($request->file('image')){
            $image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
            $user->profile_image = $image;
            $user->save();
        }
        User::where('name', $name)->update(['nickname' => $request->input('nickname')]);

        $request->profile_text = htmlspecialchars($request->profile_text,ENT_QUOTES,'UTF-8');
        $search = array('&lt;h1&gt;','&lt;/h1&gt;',
        '&lt;h2&gt;','&lt;/h2&gt;',
        '&lt;h3&gt;','&lt;/h3&gt;',
        '&lt;p&gt;','&lt;/p&gt;',
        '&lt;em&gt;','&lt;/em&gt;',
        '&lt;ol&gt;','&lt;/ol&gt;',
        '&lt;li&gt;','&lt;/li&gt;',
        '&lt;ul&gt;','&lt;/ul&gt;',
        '&lt;img','&lt;/img&gt;',
        '&lt;a','&lt;/a&gt;',
        '&lt;b&gt;','&lt;/b&gt;',
        '&lt;u&gt;','&lt;/u&gt;',
        '&lt;strong&gt;','&lt;/strong&gt;',
        '&gt;',"&#039;",
     );
        $replace = array('<h1>','</h1>','<h2>','</h2>','<h3>','</h3>',
        '<p>','</p>','<em>','</em>','<ol>','</ol>','<ul>','</ul>','<li>','</li>','<img','</img>','<a','</a>','<b>','</b>','<u>','</u>','<strong>','</strong>', '>','');
        $request->profile_text = str_replace($search,$replace,$request->profile_text);
        User::where('name', $name)->update(['profile_text' => $request->profile_text]);

        return redirect()->route('users.edit',['user' => $user, 'name' => $name]);
    }
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');
        $data = $user->articles;
        $counts_likes = 0;
        foreach ($data as $d) {
            $counts_likes += \DB::table('likes')->where('article_id', $d->id)->count();
        }
        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
            'counts_likes' => $counts_likes,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');
        $data = $user->articles;
        $counts_likes = 0;
        foreach ($data as $d) {
            $counts_likes += \DB::table('likes')->where('article_id', $d->id)->count();
        }
        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
            'counts_likes' => $counts_likes,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
