@props(['post'])

<div class="w-full pb-5 bg-dark-500 border-t border-opacity-40 POSTS">
    <!--------------
      Profile section
    ----------------->
    <div class="w-full h-12 bg-dark-500 flex items-center text-sm gap-1">
      <a href="/u/{{'@' . $post->user->username}}/profile" class="flex gap-1">
        <img src="{{$post->user->image != '' ? URL('/storage/users_profile/'. $post->user->image) : URL('/image/profile.jpg')}}" alt="" class="w-5 rounded-full" />
        {{$post->user->name}}
      </a>
      <span class="text-sm opacity-50 mr-auto">7h</span>
      <button
        data-save="{{$post->id}}"
        onclick="save(this)"
        class="hover:bg-opacity-10 hover:bg-white rounded-full text-xs w-6 h-6 flex items-center justify-center"
      >
      @auth
          
        @if ($post->saves->where('user_id' , auth()->user()->id)->first()?->post_id == $post->id)
          <i class="fa-solid fa-check text-second text-lg"></i>
        @else
          <i class="fa-solid fa-bookmark"></i>
        @endif
      @else
      <i class="fa-solid fa-bookmark"></i>
      @endauth
    </button>
      <div class="relative">
        <button
        class="hover:bg-opacity-10 hover:bg-white rounded-full text-xs w-6 h-6 flex items-center justify-center ShowMore"
      >
        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
      </button>
      <div class="absolute w-36 py-1 bg-dark-400 right-2  z-30 rounded hidden">
        <ul class="w-full h-full flex flex-col">
          <li class="w-full h-10 flex items-center"><a  class="h-10 w-full flex  px-2 items-center hover:bg-dark-300" href="#">Report Post</a></li>
          @auth
              
          @if ($post->user_id == auth()->user()->id)
          <li class="w-full h-10 flex items-center"><a  class="h-10 w-full flex px-2 items-center hover:bg-dark-300" href="/p/modify/{{$post->id}}">Modify</a></li>
          <li class="w-full h-10 flex items-center"><a  class="h-10 w-full flex px-2 items-center hover:bg-dark-300 cursor-pointer" onclick="DelPost(this)" data-id="{{$post->id}}">Delete</a></li>
          @endif
          @endauth
        </ul>
      </div>
      </div>
    </div>
    <!--------------
      discreption section
    ----------------->
    <p>
      {{$post->title}}
    </p>
    <!--------------
      Media section
    ----------------->
    <x-post-media-section :media='$post->media' />

    <!--------------
      tags section
    ----------------->
    <x-post-tags :tagsCsv='$post->tags'/>

    <!--------------
      voting section
    ----------------->
    <div class="w-full mt-2 flex items-center gap-3">
      <a
        onclick="vote(this)"
        data-vote= 'upvote'
        data-id = "{{$post->id}}"
        class="h-9 p-3 flex cursor-pointer items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300 votingBtn
        @auth
        @if($post->votes()->where('user_id' , auth()->user()->id)->first()?->status == 'upvote') clicked @endif
        @endauth
        "
        ><i class="fa-sharp fa-solid fa-arrow-up"></i> <span class="up_value">{{$post->upvotes}}</span></a
      >
      <a
        onclick="vote(this)"
        data-vote= 'downvote'
        data-id ="{{$post->id}}"
        class="h-9 p-3 flex cursor-pointer items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300 votingBtn
        @auth
        @if($post->votes()->where('user_id' , auth()->user()->id)->first()?->status == 'downvote') clicked @endif
        @endauth
        "
        ><i class="fa-sharp fa-solid fa-arrow-down"></i><span class="up_value">{{$post->downvotes}}</span></a
      >
      <a
        href="/p/{{$post->id}}"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300"
        ><i class="fa-solid fa-message"></i> <span>{{count($post->comments)}}</span></a
      >
      <a
        href="#"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300 ml-auto"
        ><i class="fa-solid fa-link"></i></a
      >
    </div>
  </div>    
