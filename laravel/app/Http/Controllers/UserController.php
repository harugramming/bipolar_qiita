<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $articles_posts = $user->articles->sortByDesc('created_at');
        $articles_likes = $user->likes->sortByDesc('created_at');
        return view('users.show', [
            'user' => $user,
            'articles_posts' => $articles_posts,
            'articles_likes' => $articles_likes,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        return  view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(string $name, Request $request){
        $user = User::where('name', $name)->first();

        if($request->file('image')){
            $path = $request->file('image')->store('public/profiles/');
            $user->profile_image = basename($path);
            $user->save();
        }
        User::where('name', $name)->update(['nickname' => $request->input('nickname')]);
        User::where('name', $name)->update(['profile_text' => $request->input('profile_text')]);
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
        $user = User::where('name', $name)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
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
