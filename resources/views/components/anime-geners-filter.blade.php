@props(['geners'])
    <div
    class="relative w-full h-10 rounded border border-gray-400 border-opacity-30"
  >
  <input type="text" name="geners" readonly id="GenersListToggle" class="h-full w-full flex items-center px-3 bg-transparent cursor-pointer outline-none" value="Select geners">
  <i class="fa-solid fa-angle-down absolute right-2.5 top-2.5"></i>
    <div
      class="w-full py-1 absolute mt-1 bg-dark-500 hidden z-50 max-h-52 overflow-y-scroll"
      id="GenersList"
    >
      <ul>
        <li>
          <p
            class="w-full h-10 flex items-center px-3 "
            >Select geners...</p
          >
        </li>
        @foreach ($geners as $gener)     
            <li>
              <a
              href="#"
              class="w-full h-10 flex items-center px-3 hover:bg-dark-300 Geners"
              data-geners="{{$gener}}"
              >{{$gener}}</a
              >
            </li>
        @endforeach
      </ul>
    </div>
  </div>
  