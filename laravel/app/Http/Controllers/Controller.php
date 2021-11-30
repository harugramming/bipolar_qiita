<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Article;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function terms()
    {
        return view('terms');
    }
    public function privacypolicy(){
        return view('privacypolicy');
    }
    public function contact(){
        return view('contact');
    }

    public function about(){
        $articles_count = Article::all()->count();
        $users_count = User::all()->count();
        return view('about',
        ['articles_count' => $articles_count,
         'users_count' => $users_count
        ]);
    }
}

