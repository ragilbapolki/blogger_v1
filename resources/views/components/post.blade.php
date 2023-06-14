@props(['post' => $post])

    <div class="mb-4">

        <a href="{{route('users.posts', $post->user)}}" class="font-bold">
            {{$post->user->name}}
        </a>
            | <span class="text-gray-400 text-sm">{{$post->created_at->diffForHumans()}}</span>
        
            <hr class="mt-2 mb-2">

            <a href="{{route('posts.show', $post->slug)}}" class="font-bold">
                {{$post->title}}
            </a>

            <p style="word-break: break-word;">{!! $post->body !!}</p>
    
            {{-- Changed to "PostPolicy" --}}
            {{-- @if ($post->ownedBy(Auth::user())) --}}
            
            @can('delete', $post)
            
            <div>
                
                <form action="{{route('posts.destroy', $post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input 
                    style="cursor: pointer"
                    class="mt-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-4 rounded" 
                    type="button" 
                    onclick="location.href='{{route('posts.edit', $post->slug)}}'" 
                    value="Edit" />
            
                    <button
                    type="submit" 
                    class="mt-2 bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded">
                    Delete
                    </button>
                      
                 </form>
            </div>
    
            @endcan

            {{-- @endif --}}
    
            <div class="flex">
    
                @auth
    
                 @if(!$post->likedBy(auth()->user()))
     
                  <form action="{{route('posts.likes', $post->id)}}" method="post" class="mr-1">
                      @csrf
                      <button type="submit" class="text-blue-500">Like</button>
                  </form>
              
                  @else
      
                  <form action="{{route('posts.dislikes', $post->id)}}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-blue-500">Unlike</button>
                  </form>
     
                 @endif
    
                @endauth

    
                <span>{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}</span>
    
            </div>
    
    </div>
