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
    <link rel="stylesheet" href="{{asset('style/style.css')}}" />
    <title>Document</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
  </head>
  <body class="relative min-h-screen text-gray-200 bg-dark-500">
    <nav
      class="flex items-center gap-3 px-2 border-b border-gray-400 border-opacity-50 h-14 w-ful sm:px-6 sm:gap-2"
    >
      <a href="/" class="w-16 mr-auto">
        <img src="{{asset('image/logo.svg')}}" alt="logo" />
      </a>

      <a href="#" class="nav-icon" id="searchFormToggle">
        <i class="fa-solid fa-magnifying-glass"></i>
      </a>
      @auth
          
      <a href="#" class="hidden nav-icon sm:flex">
        <i class="fa-solid fa-bell"></i>
      </a>
      
      @else
      
      @endauth

      <a
        href="#"
        class="flex bg-cover nav-icon bg-UserProfile"
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
            class="absolute text-gray-500 fa-solid fa-magnifying-glass left-4 top-4"
          ></i>
          <input
            type="text"
            name="query"
            id=""
            class="w-full h-full pl-8 pr-3 rounded-sm outline-none bg-dark-600"
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
          <li class="px-5 hover:bg-dark-400">
            <a href="/u/{{'@' . auth()->user()->username}}/profile" class="flex items-center w-full h-10">My Profile</a>
          </li>
              
          <li class="px-5 hover:bg-dark-400">
            <a href="/u/{{'@' . auth()->user()->username}}/saved" class="flex items-center w-full h-10">Saved</a>
          </li>
                    
          <li class="px-5 hover:bg-dark-400">
            <a href="/settings/" class="flex items-center w-full h-10">Setting</a>
          </li>
          <li class="px-5 hover:bg-dark-400">
            <a href="#" class="flex items-center w-full h-10"
              >Report Problems</a
            >
          </li>
          <li class="px-5 hover:bg-dark-400">
            <form action="/user/logout" method="post">
              @csrf
              <input type="submit" href="#" class="flex items-center w-full h-10 cursor-pointer" value='log out'>
            </form>
          </li>
          @else
          <li class="px-5 hover:bg-dark-400">
            <a href="/login" class="flex items-center w-full h-10">Sign Up / Login in</a>
          </li>
          @endauth

        </ul>
      </div>
    </nav>

    <div
      class="absolute bottom-0 right-0 z-30 hidden w-64 py-3 bg-dark-300 top-14"
      id="NavList"
    >
      <ul>
        <li class="px-5 hover:bg-dark-400">
          <a href="/" class="flex items-center w-full h-10 gap-2"
            ><i class="fa-solid fa-house"></i> Home</a
          >
        </li>
        <li class="px-5 hover:bg-dark-400">
          <a href="/anime-list" class="flex items-center w-full h-10 gap-2"
            ><i class="fa-solid fa-list"></i> Anime list</a
          >
        </li>
        <li class="px-5 hover:bg-dark-400">
          <a href="#" class="flex items-center w-full h-10 gap-2">
            <i class="fa-solid fa-arrow-trend-up"></i>
            Trending</a
          >
        </li>
        <li class="px-5 hover:bg-dark-400">
          <a href="#" class="flex items-center w-full h-10 gap-2">
            <i class="fa-solid fa-clock"></i>
            Fresh
          </a>
        </li>
        <li class="px-5 hover:bg-dark-400">
          <a href="#" class="flex items-center w-full h-10 gap-2">
            <i class="fa-solid fa-chart-simple"></i>
            Top
          </a>
        </li>

        <li class="px-5">
          <span class="flex items-center w-full h-10 gap-2 text-sm font-bold"
            >Popular Tags</span
          >
        </li>

        <li class="px-5 hover:bg-dark-400">
          <a href="#" class="flex items-center w-full h-10 gap-2">
            <i class="fa-solid fa-tag"></i>
            AMV
          </a>
        </li>
        <li class="px-5 hover:bg-dark-400">
          <a href="#" class="flex items-center w-full h-10 gap-2">
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
