<x-layout>

<div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 ">
    <x-post-card :post='$post' />
    
      <div class="w-full h-72 flex flex-col gap-4">
        <span class="font-bold text-lg pb-2 border-b border-gray-400 border-opacity-30 block">{{$post->comments}} Comments</span>
        <form action="#" class="w-full flex gap-1 justify-center sm:gap-3">
            <a
            href="#"
            class="nav-icon flex bg-UserProfile bg-cover max-w-full w-10 h-10"
            style="background-image: url('{{asset('image/profile.jpg')}}')"
          >
          </a>
          <input type="text" class="h-10 outline-none bg-transparent border-gray-400 border-opacity-30 w-3/5 sm:w-9/12" placeholder="Add Comment..">
          <a href="#" class="px-4 h-10 flex items-center bg-second rounded">Post</a>
        </form>
        
        


        
            <div class="w-full py-1 mb-6 " >
              <div class="w-full  flex items-start gap-3">
                <img src="{{asset('image/profile.jpg')}}" alt="profile Image" class="w-10 rounded-full">
                <div class="w-full pr-2">
                  <h1 class="text-sm font-bold">Lorem ipsum</h1>
                  <div class="text-sm text-gray-400 opacity-90">
                    <span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus at placeat praesentium adipisci, reiciendis itaque consectetur incidunt veritatis accusamus vitae asperiores maxime sed laudantium hic similique dolor tempora pariatur! Harum neque sapiente debitis eveniet minus placeat rem, facilis dignissimos dolore exercitationem! Dolore nihil perferendis sapiente dolores laborum, consequatur fugiat iure?</span>
                  </div>
                  <form action="#" class="h-8 w-full flex gap-2 mt-1">
                    <a href="#" class="px-5  flex items-center gap-2 border border-gray-400 border-opacity-0 hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-up"></i> 200</a>
                    <a href="#" class="px-5  flex items-center gap-2  border border-gray-400 border-opacity-0  hover:border-opacity-30 rounded"><i class="fa-sharp fa-solid fa-arrow-down"></i> 15</a>
                  </form>
                </div>
              </div>
            </div>
    </div>
  </div>
</x-layout>
