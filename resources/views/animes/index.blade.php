<x-layout>
    <div class="w-full max-w-4xl bg-dark-600 px-1 m-auto mt-3 mini-sm:px-3 py-3">
        <form action="?" method="GET" class="flex gap-3">
            <button class="text-3xl"><i class="fa-solid fa-sliders"></i></button>
            <input type="text" name="name" class="bg-transparent w-full">
            <input type="submit" value="search" class="w-28 h-10 bg-second rounded-xl ">
        </form>
    </div>
    <div class="grid w-full max-w-4xl grid-cols-1 gap-3 px-1 m-auto mt-3 mini-sm:px-3 semi-lg:px-0 semi-lg:grid-cols-2">
        @foreach ($animes as $key => $anime)
        <div class="flex w-full h-40 overflow-hidden bg-dark-300 mini-sm:h-48 ">
            <div class="h-fu:ll w-28 mini-sm:w-36">
                <a href="/anime-list/{{$anime->AM_id}}"><img src="{{URL('storage'.$anime->image)}}" class="w-full h-full" alt=""></a>
            </div>
            <div class="flex flex-col gap-1 px-2 py-2 w-2/3 sm:w-4/5 semi-lg:w-4/6">
                <a href="/anime-list/{{$anime->AM_id}}" class="font-sans text-sm font-bold mini-sm:text-base text-second line-ellipsis">{{$key + 1}} . {{$anime->name}}</a>
                <span class="text-xxs opacity-80 mini-sm:text-sm line-ellipsis" style="font-size: 13px;">{{$anime->type}} @if ($anime->geners) {{' | '. $anime->geners}} @endif</span>
                <span class="text-base leading-snug descrtiption-ellipsis">{{$anime->synopsis}}</span>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>