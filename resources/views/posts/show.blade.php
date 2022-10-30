<x-layout>
<div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 ">
    <x-post-card :post='$post' />
    
      <div class="w-full h-72 flex flex-col gap-4">
        <span class="font-bold text-lg pb-2 border-b border-gray-400 border-opacity-30 block">{{count($post->comments)}} Comments</span>
        @auth
        <p class="text-red-500" id="response_section"></p>
        <form action="/p/comment/{{$post->id}}" method="POST" id="Commentform" class="w-full flex gap-1 justify-center sm:gap-3">
          @csrf
          <a
          href="#"
          class="nav-icon flex bg-UserProfile bg-cover max-w-full w-10 h-10"
          id="cmnt_prf_img"
          style="background-image: url('{{auth()->user()->image != '' ? URL('/storage/users_profile/'. auth()->user()->image) : URL('/image/profile.jpg')}}')"
          >
        </a>
        <input type="text" class="h-10 outline-none bg-transparent border-gray-400 border-opacity-30 w-3/5 sm:w-9/12" name="comment_content" id="comment_content" placeholder="Add Comment..">
        <button type="submit" class="px-4 h-10 flex items-center bg-second rounded">Post</button>
      </form>
      @endauth
        
        

        
            <div class="w-full py-1 mb-6 " id="comments_container">
              @forelse ($post->comments as $comment)
                  
              <div class="w-full  flex items-start gap-3">
                <img src="{{$comment->user->image != '' ? URL('/storage/users_profile/'. $comment->user->image) : URL('/image/profile.jpg')}}" alt="profile Image" class="w-10 rounded-full">
                <div class="w-full pr-2">
                  <a href="/u/{{$comment->user->id}}/profile" class="text-sm font-bold">{{$comment->user->name}}</a>
                  <div class="text-sm text-gray-400 opacity-90">
                    <span>{{$comment->comment_content}}</span>
                  </div>
                  <form action="#" class="h-8 w-full flex gap-2 mt-1">
                    <a href="#" class="px-5  flex items-center gap-2 border border-gray-400 border-opacity-0 hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-up"></i> 0</a>
                    <a href="#" class="px-5  flex items-center gap-2  border border-gray-400 border-opacity-0  hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-down"></i> 0</a>
                  </form>
                </div>
              </div>
              @empty
                  <p id="empty_text">No comment</p>
              @endforelse
            </div>
    </div>
  </div>
  <script>
    console.log($('#cmnt_prf_img').css('background-image'));
    function setCMNT(cmnt) {
      return `<div class="w-full  flex items-start gap-3">
            <a class="nav-icon flex bg-UserProfile bg-cover max-w-full w-10 h-10" id="cmnt_prf_img" style="background-image: url('{{auth()->user()->image != '' ? URL('/storage/users_profile/'. auth()->user()->image) : URL('/image/profile.jpg')}}')" ></a>
                <div class="w-full pr-2">
                  <a href="/u/1/profile" class="text-sm font-bold">{{auth()->user()->name}}</a>
                  <div class="text-sm text-gray-400 opacity-90">
                    <span>`+cmnt+`</span>
                  </div>
                  <form action="#" class="h-8 w-full flex gap-2 mt-1">
                    <a href="#" class="px-5  flex items-center gap-2 border border-gray-400 border-opacity-0 hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-up"></i> 0</a>
                    <a href="#" class="px-5  flex items-center gap-2  border border-gray-400 border-opacity-0  hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-down"></i> 0</a>
                  </form>
                </div>
              </div>`
    }
    $('#Commentform').on('submit', function(e) {
      e.preventDefault();
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = this;
            var resp_sec = document.querySelector('#response_section');
            $.ajax({
              url:$(form).attr('action'),
              method: $(form).attr('method'),
              data: new FormData(form),
              dataType: "json",
              contentType: false,
              processData: false,

              success: function (response) {
                if (response.status == 400) {
                  
                  $.each(response.errors, function (key, error_value) {
                    resp_sec.classList.replace('text-second', 'text-red-500');
                    resp_sec.innerHTML = error_value;
                    console.log(error_value);
                  })
                }else {
                  resp_sec.classList.replace('text-red-500', 'text-second');
                  if ($('#empty_text')) {
                    $('#empty_text').hide();
                  }
                  $('#response_section').text(response.errors);
                  $('#comments_container').prepend(setCMNT($('#comment_content').val()));
                  $('#comment_content').val('')
                }
              },

            })
    })
  </script>
</x-layout>
