@props(['media'])
@php
$file_extention = substr($media, strpos($media, ".") + 1);
@endphp

@if (in_array($file_extention, ['jpg','jpeg','gif','png']))
    <div class="w-full bg-black min-h-96 mt-2 relative" >
        <img src="{{URL('storage/media/'.$media)}}" alt="" class="mx-auto" />
    </div>
    @else
    <div class="w-full bg-black min-h-96 mt-2 relative" onclick="playv(this)">
    <div class="absolute h-10 w-10 rounded-full bottom-4 left-4 flex items-center justify-center ">
        <i class="fa-solid sound-video-icon fa-volume-xmark"></i>
    </div>
    <video class="mx-auto relative"  autoplay muted loop id="video">
        <source src="{{URL('storage/media/'.$media)}}" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
    @endif