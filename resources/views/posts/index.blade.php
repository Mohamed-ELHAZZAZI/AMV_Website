<x-layout>

    <div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3">
        @isset($tag)
        <div class="w-full py-1 mb-6 border-b border-gray-400 border-opacity-30 pb-5 sm:pb-10">
            <h1 class="text-6xl sm:text-8xl">#{{$tag}}</h1>    
        </div>
        @endisset
        @isset($search)
            <div class="w-full py-5 border-b border-gray-400 border-opacity-30 ">
                <form action="/search/" class="w-full relative">
                    <i class="fa-solid fa-magnifying-glass absolute top-3 left-3"></i>
                    <input type="text" value="{{$search}}" name="querye" class=" h-10 pl-10 pr-2 w-full bg-transparent border-b border-gray-400 border-opacity-30">
                </form>
            </div>
        @endisset
        @unless (count($posts) == 0)
            
        @foreach ($posts as $post)
        <x-post-card :post="$post" />
        @endforeach
        @else

        <div class="w-full h-72 bg-black flex items-center justify-center">
            <h2 class="text-xl">No posts available!</h2>
        </div>

        @endunless
    </div>  
    
    <script>
        function save(e) {
            var post_id = $(e).data('save');
            var url = '/p/save/' +post_id
            var first = $(e).children().first();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: url,
                method: 'POST' ,
                dataType: "json",
                contentType: false,
                processData: false,
                
                success: function(response) {
                    if (response.status == 200) {
                        
                        first.replaceWith('<i class="fa-solid fa-check text-second text-lg"></i>')
                    }else if(response.status == 250) {
                        first.replaceWith('<i class="fa-solid fa-bookmark"></i>')
                    }else {
                        alert(response.message)
                    }
                }
            })
        }
    </script>

</x-layout>