<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }
    
    public function index() {

        $user = Auth::user();

        return view('dashboard', [
            'user' => $user,
        ]);

    }

}
