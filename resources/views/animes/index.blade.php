<x-layout>
    <div class="grid w-full max-w-4xl grid-cols-2 gap-3 m-auto mt-3">
        @foreach ($animes as $key => $anime)

        <div class="flex w-full h-40 overflow-hidden bg-dark-300 mini-sm:h-48 ">
            <div class="w-auto h-full min-w-max">
                <a href="/anime-list/{{$anime->AM_id}}"><img src="{{URL('storage'.$anime->image)}}" class="w-full h-full" alt=""></a>
            </div>
            <div class="flex flex-col h-56 gap-1 px-2 py-2 w-fit">
                <a href="/anime-list/{{$anime->AM_id}}" class="text-sm mini-sm:text-base">{{$key + 1}} . {{$anime->name . ' ' .$anime->datePublished}}</a>
                <span class="text-xxs opacity-90 mini-sm:text-sm" style="font-size: 13px">{{$anime->contentRating.' | '. $anime->genre}}</span>
                <span class="text-base leading-snug descrtiption-ellipsis">{{$anime->description}}</span>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>