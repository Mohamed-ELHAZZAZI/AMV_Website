<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <title>Document</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
  </head>
    <style>
      .clicked {
        border-color: #3b82f6;
        color: #3b82f6
      }
    </style>
  <body class="bg-dark-500 text-gray-200 relative min-h-screen">
    <nav
      class="h-14 w-ful border-b border-gray-400 border-opacity-50 flex gap-3 items-center px-2 sm:px-6 sm:gap-2"
    >
      <a href="/" class="w-16 mr-auto">
        <img src="{{asset('image/logo.svg')}}" alt="logo" />
      </a>

      <a href="#" class="nav-icon" id="searchFormToggle">
        <i class="fa-solid fa-magnifying-glass"></i>
      </a>
      @auth
          
      <a href="#" class="nav-icon hidden sm:flex">
        <i class="fa-solid fa-bell"></i>
      </a>
      
      @else
      
      @endauth

      <a
        href="#"
        class="nav-icon flex bg-UserProfile bg-cover"
        id="profileListToggle"
        style="background-image: url('@auth{{auth()->user()->image != '' ? URL('/storage/users_profile/'. auth()->user()->image) : URL('/image/profile.jpg')}}@else {{URL('/image/profile.jpg')}} @endauth ')"
      >
      </a>

      <a
        href="/create"
        class="p-1.5 rounded-full box-content flex items-center justify-evenly bg-second text-sm font-bold fixed bottom-10 right-6 w-12 h-12 z-20 sm:bg-second sm:w-16 sm:h-6 sm:relative sm:bottom-auto sm:right-auto"
      >
        <i class="fa-solid fa-plus"></i>
        <span class="hidden sm:block">Post</span>
      </a>

      <a
        href="#"
        class="p-1.5 rounded-full hover:bg-opacity-10 hover:bg-white"
        id="NavListToggle"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-7 h-7"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
          />
        </svg>
      </a>

      <div
        class="h-12 w-72 bg-dark-500 py-1.5 px-2 rounded-md border border-gray-400 border-opacity-50 hidden absolute top-50px right-6 z-50 sm:right-32 sm:w-80"
        id="searchForm"
      >
        <form action="/search" method="get" class="w-full h-full">
          <i
            class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-500"
          ></i>
          <input
            type="text"
            name="query"
            id=""
            class="w-full h-full outline-none pr-3 pl-8 rounded-sm bg-dark-600"
            placeholder="Search..."
          />
        </form>
      </div>

      <div
        class="absolute min-h-52 w-64 bg-dark-500 text-sm py-1.5 rounded-md border border-gray-400 border-opacity-50 hidden top-50px right-8 z-50 sm:w-72 sm:right-16"
        id="profileList"
      >
        <ul>
          @auth
          <li class="hover:bg-dark-400 px-5">
            <a href="/u/{{'@' . auth()->user()->username}}/profile" class="w-full h-10 flex items-center">My Profile</a>
          </li>
              
          <li class="hover:bg-dark-400 px-5">
            <a href="/u/{{'@' . auth()->user()->username}}/saved" class="w-full h-10 flex items-center">Saved</a>
          </li>
                    
          <li class="hover:bg-dark-400 px-5">
            <a href="/settings/" class="w-full h-10 flex items-center">Setting</a>
          </li>
          <li class="hover:bg-dark-400 px-5">
            <a href="#" class="w-full h-10 flex items-center"
              >Report Problems</a
            >
          </li>
          <li class="hover:bg-dark-400 px-5">
            <form action="/user/logout" method="post">
              @csrf
              <input type="submit" href="#" class="w-full h-10 flex items-center cursor-pointer" value='log out'>
            </form>
          </li>
          @else
          <li class="hover:bg-dark-400 px-5">
            <a href="/login" class="w-full h-10 flex items-center">Sign Up / Login in</a>
          </li>
          @endauth

        </ul>
      </div>
    </nav>

    <div
      class="w-64  py-3 bg-dark-300 absolute right-0 bottom-0 top-14 z-30 "
      id="NavList"
    >
      <ul>
        <li class="hover:bg-dark-400 px-5">
          <a href="/" class="w-full h-10 flex items-center gap-2"
            ><i class="fa-solid fa-house"></i> Home</a
          >
        </li>
        <li class="hover:bg-dark-400 px-5">
          <a href="/anime-list" class="w-full h-10 flex items-center gap-2"
            ><i class="fa-solid fa-list"></i> Anime list</a
          >
        </li>
        <li class="hover:bg-dark-400 px-5">
          <a href="#" class="w-full h-10 flex items-center gap-2">
            <i class="fa-solid fa-arrow-trend-up"></i>
            Trending</a
          >
        </li>
        <li class="hover:bg-dark-400 px-5">
          <a href="#" class="w-full h-10 flex items-center gap-2">
            <i class="fa-solid fa-clock"></i>
            Fresh
          </a>
        </li>
        <li class="hover:bg-dark-400 px-5">
          <a href="#" class="w-full h-10 flex items-center gap-2">
            <i class="fa-solid fa-chart-simple"></i>
            Top
          </a>
        </li>

        <li class="px-5">
          <span class="w-full h-10 flex items-center gap-2 text-sm font-bold"
            >Popular Tags</span
          >
        </li>

        <li class="hover:bg-dark-400 px-5">
          <a href="#" class="w-full h-10 flex items-center gap-2">
            <i class="fa-solid fa-tag"></i>
            AMV
          </a>
        </li>
        <li class="hover:bg-dark-400 px-5">
          <a href="#" class="w-full h-10 flex items-center gap-2">
            <i class="fa-solid fa-tag"></i>
            Funny
          </a>
        </li>
      </ul>
    </div>

    {{$slot}}

    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script>
      function vote(a) {
        var post_id = $(a).data('id');
        var vote = $(a).attr('data-vote');
        var url = '/p/'+ post_id + '/vote/'
        if (vote === 'upvote') {
          otherBTN = $(a).nextAll('.votingBtn');
        }else if (vote == 'downvote') {
          otherBTN = $(a).prevAll('.votingBtn');  
        }
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  
        $.ajax({
          url: url + vote,
          method: 'POST' ,
          dataType: "json",
          contentType: false,
          processData: false,
  
          success: function (response) {
            if (response.status == 404) {
  
              alert('Error, try again later');
  
            }else if (response.status == 502) {
  
              $(a).removeClass('clicked')
              var value = parseInt($(a).text()) - 1
              $(a).children('.up_value').html(value)
  
            } else {
              $(a).addClass('clicked')
              var value = parseInt($(a).text()) + 1
              $(a).children('.up_value').html(value)
              if(response.other_selected) {
                var value = parseInt(otherBTN.text()) - 1
                otherBTN.children('.up_value').html(value)
              }
              otherBTN.removeClass('clicked');
            }
          },
      })
      }
    </script>
  
  </body>
</html>
