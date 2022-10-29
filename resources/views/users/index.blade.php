<x-layout>
    <div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 min-h-screen">
        <div class="w-full py-1 bg-dark-500 mb-6 " >
          <div class="w-full h-32 bg-dark-500 flex items-center gap-3">
            <img src="{{asset('/image/profile.jpg')}}" alt="profile Image" class="w-24 rounded-full">
            <div class="">
              <h1 class="text-2xl font-bold">{{$user->name}}</h1>
              <div class="text-sm text-gray-400 opacity-50">
                <span>{{'@'.$user->username}}</span>
                <i class="fa-solid fa-circle text-5xs mx-1"></i>
                <span>250 days</span>
              </div>
            </div>
          </div>
          <div class="w-full pr-1 text-sm">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta a harum odio reprehenderit suscipit cupiditate sint modi voluptatibus tempora quidem?</p>
          </div>
        </div>

        <div class="w-full h-10 border-b border-gray-400 border-opacity-10 mb-4">
            <ul class="flex h-full">
              <li><a href="/u/{{$user->id}}/posts" class="flex items-center px-3 h-full border-white @if($param == 'profile') border-b-2 @else opacity-40 @endif">Posts</a></li>
              @auth
                @if ((auth()->user()->id == $user->id))
                  <li><a href="/u/{{$user->id}}/saved" class="flex items-center px-3 h-full  border-white @if($param == 'saved') border-b-2 @else opacity-40 @endif">Saved</a></li>
                @endif
              @endauth
            </ul>
          </div>
    




          @if ($param == 'profile')
            @unless (count($user->posts) == 0)    
                @foreach ($user->posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            @else
                <div id="SavedPost">
                 <div class="w-full h-72 bg-black flex flex-col items-center justify-center gap-3">
                  <h3 class="font-bold text-2xl ">No Posts</h3>
                  <p class="opacity-30 text-sm tracking-wider">Let's make something creative for fun!</p>
                  <a href="/create" class="bg-second h-10 flex items-center justify-center w-24 rounded-lg gap-2"><i class="fa-solid fa-plus text-sm"></i> Post</a>
                </div>
                </div>
             @endunless
             @endif  
          @auth
              
          @if (($param == 'saved') && (auth()->user()->id == $user->id))
          <div id="SavedPost">
            <div class="w-full h-72 bg-black flex flex-col items-center justify-center gap-3">
              <h3 class="font-bold text-2xl ">No saved posts</h3>
            </div>
          </div>
          @endif
          @endauth
          

    </div>
</x-layout>