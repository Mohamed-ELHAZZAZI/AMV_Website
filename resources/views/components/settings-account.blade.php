<div
      class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 py-3 bg-dark-300 px-3 md:px-5"
    >
      <form action="/user/update-account" method="POST" class="flex flex-col gap-2">
        @csrf
        @method('PUT')
        <a href="#" class="text-2xl md:text-3xl font-bold h-12 flex items-center" id="setting-account-toggle">Account <i class="fa-solid fa-angle-up ml-auto transform" id="setting-account-cursor"></i></a>
        <div class="hidden flex-col gap-2"  id="setting-account">
        <span class="font-bold">Username</span>
        @error('username')
          <p class="text-sm text-red-500">{{$message}}</p>
        @enderror 
        <input
          type="text"
          name="username"
          value="@if(old('username')){{old('username')}}@else{{auth()->user()->username}}@endif"
          class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 px-3 outline-none"
        />
        <span class="font-bold">Email</span>
        @error('email')
          <p class="text-sm text-red-500">{{$message}}</p>
        @enderror 
        <input
          type="email"
          name="email"
          value="@if(old('email')){{old('email')}} @else {{auth()->user()->email}} @endif"
          class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 px-3 outline-none"
        />
        <input 
          type="submit"
          value="Save Changes"
          class="px-10 h-10 flex items-center justify-center bg-second w-full cursor-pointer"
          >
        </div>
      </form>
    </div>