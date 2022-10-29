@props(['post'])


<div class="w-full pb-5 bg-dark-500 border-t border-opacity-40 POSTS">
    <!--------------
      Profile section
    ----------------->
    <div class="w-full h-12 bg-dark-500 flex items-center text-sm gap-1">
      <a href="/u/{{'@' . $post->user->username}}/profile" class="flex gap-1">
        <img src="{{asset('image/profile.jpg')}}" alt="" class="w-5 rounded-full" />
        {{$post->user->name}}
      </a>
      <span class="text-sm opacity-50 mr-auto">7h</span>
      <a
        href="#"
        class="hover:bg-opacity-10 hover:bg-white rounded-full text-xs w-6 h-6 flex items-center justify-center"
      >
        <i class="fa-solid fa-bookmark"></i>
      </a>
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
        href="#"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300"
        ><i class="fa-sharp fa-solid fa-arrow-up"></i> {{$post->upvotes}}</a
      >
      <a
        href="#"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300"
        ><i class="fa-sharp fa-solid fa-arrow-down"></i>{{$post->downvotes}}</a
      >
      <a
        href="/p/{{$post->id}}"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300"
        ><i class="fa-solid fa-message"></i> {{$post->comments}}</a
      >
      <a
        href="#"
        class="h-9 p-3 flex items-center justify-center border border-gray-400 border-opacity-40 rounded gap-2 hover:bg-dark-300 ml-auto"
        ><i class="fa-solid fa-link"></i></a
      >
    </div>
  </div>    
