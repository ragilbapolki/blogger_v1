<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    
    public function index() {
        
        $user = Auth::user();

        return view('admin.quotes.index', [
            'user' => $user,
        ]);

    }

    public function store(QuoteRequest $request) {

        $input = $request->all();

        // $this->validate($request, [
        //     'author' => 'required',
        //     'body' => 'required',
        // ]);

        // Quote::create([
        //     'author' => $request->author,
        //     'body' => $request->body,
        //     'user_id' => Auth::user()->id,
        // ]);

        Auth::user()->quotes()->create($input)->with('session', 'ss');

        return back()->with('success-quote', 'You have successfully published your quote!');

    }



}
