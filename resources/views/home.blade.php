@extends('layouts.app')

<title>Home</title>

@section('content')

<div id="loader"></div>

<div style="display:none;" id="myDiv">

<div class="flex justify-center">
<div class="w-8/12 bg-white p-6 rounded-sm">

@if (session()->has('logged-in'))
<div class="bg-green-500 p-1 rounded-sm mb-6 text-white text-center">
    {{session('logged-in')}}
</div>
@endif

@if (session()->has('registered'))
<div class="bg-green-500 p-1 rounded-sm mb-6 text-white text-center">
    {{session('registered')}}
</div>
@endif

<h1 class="font-bold">Welcome back<span class="text-blue-700">{{Auth::check() ? ' ' . Auth::user()->name : ' there!'}}</span></h1>
<p class="mt-2">How are you today..? I have an quote for you, hope you will like it &#128512;</p>
<p class="mt-2 mb-2 text-rose-500">Quote:</p>

@if ($quote)

<p>"{{$quote->body}}" - <span style="font-style: italic">{{$quote->author}}</span></p>

@else

<p>There are no quotes at the moment..</p>

@endif

</div>

</div>

<div class="flex justify-center mt-5">

<div class="container">

  @foreach ($posts as $post)
  <div class="card">
    <div class="card__header">
      <img src="{{$post->picture == 'no-picture' ? $post->placeholder : '/storage/images/posts/' . $post->picture}}" alt="Post Image" class="card__image" width="600">
    </div>
    <div class="card__body" style="text-align: justify">
      <h4><a href="{{route('posts.show', $post->slug)}}">{{$post->title}}</a></h4>
      @if (strlen($post->body) >= '200') 
        <p style="text-align: justify">{!! substr($post->body,0,200) !!} ...</p>
      @else 
        <p style="text-align: justify">{!! $post->body !!} </p>
      @endif
      <a href="{{route('posts.show', $post->slug)}}"> <button class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Read full article</button> </a>
    </div>
    <div class="card__footer">
      <div class="user">
      <img style="height: 40px" 
      src="{{$post->user->picture == "/storage/profile_images/no-picture" ? $post->user->random : $post->user->picture}}"
      alt="User Image" class="user__image">
        <div class="user__info">
          <h5>{{$post->user->name}}</h5>
          <small>{{$post->created_at->diffForHumans()}}</small>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

</div>

</div>








@endsection