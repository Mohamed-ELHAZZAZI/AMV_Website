@props(['media'])
@php
$file_extention = substr($media, strpos($media, ".") + 1);
@endphp

<div class="w-full bg-black min-h-96 mt-2 relative ">
@if (in_array($file_extention, ['jpg','jpeg','gif','png']))
        <img src="{{URL('storage/media/'.$media)}}" alt="" class="mx-auto ElementMedia" />
    @else
    <video class="mx-auto relative ElementMedia"  controls muted loop id="video">
        <source src="{{URL('storage/media/'.$media)}}" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      @endif
</div>