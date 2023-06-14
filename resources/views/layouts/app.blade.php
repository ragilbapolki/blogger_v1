<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    {{-- Icon --}}
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png">
    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- External CSS --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- TinyMCE --}}
    <x-head.tinymce-config/>
    
</head>

<body class="bg-gray-200" onload="myFunction()">
    
    <nav class="p-6 bg-white flex justify-between mb-6">
       <ul class="flex items-center">
        <a href="/"> <img src="{{asset('img/logo-black.png')}}"  width="60" alt="Bootstrappin'"></a>&nbsp;
        <li>
            <a style="transition: 0.25s" href="/" class="p-2 rounded-sm
            
            {{ (request()->is('home')) ? 'border-b-2 border-indigo-500' : '' }}

            ">Home</a>
        </li>
        

        <li>
            <a href="{{route('posts')}}" class="p-2 
            
            {{ (request()->is('posts')) || (request()->is('search')) ? 'border-b-2 border-indigo-500' : '' }}

            ">Post</a>
        </li>

        @guest

        @endguest

        @auth
        
        @if (Auth::user()->admin == 'true' || Auth::user()->admin == 'TRUE')

        <li>
            <a href="{{route('quotes')}}" class="p-2 
            
            {{ (request()->is('quotes')) ? 'border-b-2 border-indigo-500' : '' }}

            ">Quote</a>
        </li> 

        @endif

        @endauth

       </ul>

       <ul class="flex items-center">

        @auth
        <li>
            <a href="{{route('users.profile', $user)}}" class="p-3 text-hover">{{Auth::user()->name}}</a>
        </li>
        <li>
            <form action="{{route('logout')}}" method="post" class="inline p-2 bg-blue-400 hover:bg-sky-700 text-white rounded-sm">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
        @endauth

        @guest
        <li class="p-1
        
        {{ (request()->is('login')) ? 'border-b-2 border-indigo-500' : '' }}

        ">
            <a href="{{route('login')}}" class="p-3">Log In</a>
        </li>
        <li class="p-1
        
        {{ (request()->is('register')) ? 'border-b-2 border-indigo-500' : '' }}

        ">
            <a href="{{route('register')}}" class="p-3">Register</a>
        </li>
        @endguest
        
       </ul>
    </nav>

@yield('content')

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/2824446f9a.js" crossorigin="anonymous"></script>
{{-- Preloader --}}
<script type="text/javascript" src="{{asset('js/preloader/preloader.js')}}"></script>
{{-- Credentials --}}
<script type="text/javascript" src="{{asset('js/credentials/credentials.js')}}"></script>

</body>

</html>