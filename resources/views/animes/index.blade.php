<x-layout>
    <div class="md:w-full md:max-w-4xl bg-dark-600 px-1 m-auto mt-3 mini-sm:px-3 py-2 sm:py-3 rounded-lg" style="width: 97%">
        <form action="?" method="GET" class="flex gap-1 h-10 sm:gap-3">
            <button type="button" class="text-base rounded-full flex gap-2 items-center justify-center w-10 h-10 sm:w-28 hover:bg-dark-500"><i class="fa-solid fa-sliders"></i> <span class="hidden sm:block">filters</span></button>
            <input type="text" name="name" class="bg-transparent w-3/4 max-w-xl sm:w-full" value="@if(request('name')){{request('name')}}@endif">
            <button type="submit" class="w-9 h-9 bg-second rounded-full  mini-sm:ml-2 sm:ml-auto mini-sm:rounded-xl mini-sm:w-28 sm:w-36 mini-sm:h-10"><span class="hidden mini-sm:block">Search</span><i class="fa-solid fa-magnifying-glass mini-sm:hidden"></i></button>
        </form>
    </div>
    <div class="flex flex-col w-full max-w-4xl grid-cols-1 gap-3 px-1 m-auto mt-3 mini-sm:px-3 semi-lg:px-0 semi-lg:grid semi-lg:grid-cols-2">
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
        <div class="col-span-2">
            {{$animes->links()}}
        </div>
    </div>
</x-layout>