<x-layout>
    <div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3  flex flex-col gap-3">
        @foreach ($animes as $key => $anime)

        <div class="w-full h-40 flex bg-dark-300 mini-sm:h-56 ">
            <div class="h-full w-32 mini-sm:w-40">
                <a href="/anime-list/{{$anime->AM_id}}"><img src="{{URL('storage/anime/AM0420497.jpg')}}" class="w-full h-full" alt=""></a>
            </div>
            <div class="h-56 px-3 py-2 flex flex-col gap-2">
                <a href="/anime-list/{{$anime->AM_id}}" class="text-sm mini-sm:text-base">{{$key + 1}} . {{$anime->name . ' ' .$anime->datePublished}}</a>
                <span class="text-xxs opacity-90 mini-sm:text-sm" style="font-size: 13px">{{$anime->contentRating.' | '. $anime->genre}}</span>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>