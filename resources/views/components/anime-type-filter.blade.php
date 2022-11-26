@props(['types'])
    <div
  class="relative w-full h-10 rounded border border-gray-400 border-opacity-30"
>
<input type="text" name="type" readonly id="TypeListToggle" class="h-full w-full flex items-center px-3 bg-transparent cursor-pointer outline-none" value="Select type">
<i class="fa-solid fa-angle-down absolute right-2.5 top-2.5"></i>
  <div
    class="w-full py-1 absolute mt-1 bg-dark-500 hidden z-50 max-h-52 overflow-y-scroll"
    id="TypeList"
  >
    <ul>
      <li>
        <p
          class="w-full h-10 flex items-center px-3 "
          >Select type...</p
        >
      </li>
      @foreach ($types as $type)    
          <li>
            <a
            href="#"
            class="w-full h-10 flex items-center px-3 hover:bg-dark-300 Type"
            data-type="{{$type}}"
            >{{$type}}</a
            >
        @endforeach
      </li>
    </ul>
  </div>
</div>
