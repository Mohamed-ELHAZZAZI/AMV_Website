<div
      class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 py-3 bg-dark-300 px-3 md:px-5"
    >
      <form action="/user/update-password" method="POST" class="flex flex-col gap-2">
        @csrf
        @method('PUT')
        <a href="#" class="text-2xl md:text-3xl font-bold h-12 flex items-center" id="setting-password-toggle">Password <i class="fa-solid fa-angle-up ml-auto transform" id="setting-password-cursor"></i></a>
        <div class="hidden flex-col gap-2"  id="setting-password">
        <span class="font-bold">Old password</span>
        @error('OldPassword')
          <p class="text-sm text-red-500">{{$message}}</p>
        @enderror 
        <input
          type="password"
          name="OldPassword"
          value="{{old('OldPassword')}}"
          class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 px-3 outline-none"
        />
        <span class="font-bold">New password</span>
        @error('password')
          <p class="text-sm text-red-500">{{$message}}</p>
        @enderror 
        <input
          type="password"
          name="password"
          value="{{old('password')}}"
          class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 px-3 outline-none"
        />
        <span class="font-bold">Re-enter new password</span>
        <input
          type="password"
          name="password_confirmation"
          value="{{old('password_confirmation')}}"
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