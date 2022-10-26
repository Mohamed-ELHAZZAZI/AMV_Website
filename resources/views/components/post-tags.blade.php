@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv) ;
@endphp

<div class="w-full mt-2 flex items-center gap-2">
@foreach ($tags as $tag)
    <a
      href="/tag/{{$tag}}"
      class="h-9 p-3 flex items-center justify-center bg-dark-400 rounded hover:bg-dark-300"
      >{{$tag}}</a
    >
@endforeach
</div>