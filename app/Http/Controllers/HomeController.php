<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post, Quote};
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function redirect() {
        return to_route('home');
    }

    public function indexHome() {
        $quote = Quote::latest('created_at')->first();
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $user = Auth::user();

        return view('home', [
            'quote' => $quote,
            'user' => $user,
            'posts' => $posts,
        ]);
    }


}
