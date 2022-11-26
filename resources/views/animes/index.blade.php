<x-layout>
    <div class="md:w-full md:max-w-4xl bg-dark-600 px-1 m-auto mt-3 mini-sm:px-3 py-2 sm:py-3 rounded-lg" style="width: 97%">
        <form action="" method="GET" class="flex gap-1 h-10 sm:gap-3" id="search_name_form">
            <button type="button" class="text-base rounded-full flex gap-2 items-center justify-center w-10 h-10 sm:w-24 hover:bg-dark-500" id="filters_toggle"><i class="fa-solid fa-sliders"></i> <span class="hidden sm:block">filters</span></button>
            <input type="text" name="name" class="bg-transparent w-3/4 max-w-xl sm:w-full" value="@if(request('name')){{request('name')}}@endif" placeholder="Search by name" id="default_name_search">
            <button type="submit" class="w-9 h-9 bg-second rounded-full  mini-sm:ml-2 sm:ml-auto mini-sm:rounded-xl mini-sm:w-28 sm:w-36 mini-sm:h-10" id="search_name"><span class="hidden mini-sm:block" >Search</span><i class="fa-solid fa-magnifying-glass mini-sm:hidden"></i></button>
        </form>
        <form action="?" method="GET" class="hidden" id="filters_container">
            <div class="w-full mt-10 gap-x-8 gap-y-4 flex flex-col sm:grid sm:grid-cols-2">
                    <input type="hidden" name="name" id="hidden_name_search">
                    <x-anime-type-filter :types="$types" />
                    <x-anime-demographics-filter :demogs="$demog"/>
                    <x-anime-geners-filter :geners="$geners"/>
                    <x-anime-season-filter />
                <button type="submit" class="h-10 bg-second col-span-2"><span class="hidden mini-sm:block" >Search</span><i class="fa-solid fa-magnifying-glass mini-sm:hidden"></i></button>
            </div>
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

    <script>
        $('#search_name_form').on('submit', function(e) {
            if (!$('#filters_container').hasClass('hidden')) {
                e.preventDefault()
                $('#filters_container').submit()
            }
        })

        $('#filters_container').on('submit', function() {
            value = $('#default_name_search').val()
            $('#hidden_name_search').val(value)
        })

        $('#filters_toggle').on('click', function() {
            $('#filters_container').toggleClass('hidden')
            $('#filters_toggle').toggleClass('bg-dark-500')
            $('#search_name').toggleClass('hidden')
            if ($('#default_name_search').hasClass('max-w-xl')) {
                $('#default_name_search').removeClass('max-w-xl')
                $('#default_name_search').addClass('max-w-2xl')
            }else {
                $('#default_name_search').removeClass('max-w-2xl')
                $('#default_name_search').addClass('max-w-xl')
            }
        })


        //type filter

        var TypeListToggle = document.querySelector("#TypeListToggle");
        var TypeList = document.querySelector("#TypeList");

        if (TypeListToggle != null) {
            TypeListToggle.addEventListener("click", function () {
            if (TypeList.classList.contains("hidden")) {
                TypeList.classList.remove("hidden");
                GenersList.classList.add("hidden");
                DemographicsList.classList.add("hidden");
                SeasonList.classList.add("hidden");
            } else {
                TypeList.classList.add("hidden");
            }
            });
        }

        $('.Type').on('click', function(e) {
            e.preventDefault();
            var value = $(this).attr('data-type');
            $('#TypeListToggle').attr('value' , value)
            TypeList.classList.add("hidden");
        })

        //Demographics filter

        var DemographicsListToggle = document.querySelector("#DemographicsListToggle");
        var DemographicsList = document.querySelector("#DemographicsList");

        if (DemographicsListToggle != null) {
            DemographicsListToggle.addEventListener("click", function () {
            if (DemographicsList.classList.contains("hidden")) {
                DemographicsList.classList.remove("hidden");
                TypeList.classList.add("hidden");
                GenersList.classList.add("hidden");
                SeasonList.classList.add("hidden");
            } else {
                DemographicsList.classList.add("hidden");
            }
            });
        }

        $('.Demographics').on('click', function(e) {
            e.preventDefault();
            var value = $(this).attr('data-demographics');
            $('#DemographicsListToggle').attr('value' , value)
            DemographicsList.classList.add("hidden");
        })

        //Geners filter


        var GenersListToggle = document.querySelector("#GenersListToggle");
        var GenersList = document.querySelector("#GenersList");

        if (GenersListToggle != null) {
            GenersListToggle.addEventListener("click", function () {
            if (GenersList.classList.contains("hidden")) {
                GenersList.classList.remove("hidden");
                DemographicsList.classList.add("hidden");
                TypeList.classList.add("hidden");
                SeasonList.classList.add("hidden");
            } else {
                GenersList.classList.add("hidden");
            }
            });
        }

        $('.Geners').on('click', function(e) {
            e.preventDefault();
            var value = $(this).attr('data-geners');
            $('#GenersListToggle').attr('value' , value)
            GenersList.classList.add("hidden");
        })

        //season filter

        var SeasonListToggle = document.querySelector("#SeasonListToggle");
        var SeasonList = document.querySelector("#SeasonList");

        if (SeasonListToggle != null) {
            SeasonListToggle.addEventListener("click", function () {
            if (SeasonList.classList.contains("hidden")) {
                SeasonList.classList.remove("hidden");
                GenersList.classList.add("hidden");
                DemographicsList.classList.add("hidden");
                TypeList.classList.add("hidden")
            } else {
                SeasonList.classList.add("hidden");
            }
            });
        }

        $('.Season').on('click', function(e) {
            e.preventDefault();
            var value = $(this).attr('data-season');
            $('#SeasonListToggle').attr('value' , value)
            SeasonList.classList.add("hidden");
        })

    </script>
</x-layout>