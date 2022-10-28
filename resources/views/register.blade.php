<x-layout>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="w-72 bg-dark-400 pt-3 pb-4 px-2 rounded sm:w-96 m-auto" style="min-height: 350px">
            
            <form class="px-2 flex flex-col" id="SignUpForm" method="POST" action="/user/store">
                @csrf
                <h1 class="text-center text-4xl pb-4">Sign Up</h1>
                <label for="" class="flex flex-col gap-1 pb-4">
                  <span class="pb-1">Full name: </span>
                  @error('name')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror 
                  <input type="text" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="name" value="{{old('name')}}" required>
                </label>
                <label for="" class="flex flex-col gap-1 pb-4">
                  <span class="pb-1">username: </span>
                  @error('username')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror 
                  <input type="text" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="username" value="{{old('username')}}" required>
                </label>
                <label for="" class="flex flex-col gap-1 pb-4">
                  <span class="pb-1">Email: </span>
                  @error('email')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror 
                  <input type="email" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="email" value="{{old('email')}}" required>
                </label>
                <label for="" class="flex flex-col pb-4">
                  <span class="pb-1">Password: </span>
                  @error('password')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror
                  <input type="password" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="password" value="{{old('password')}}" required>
                </label>
                <label for="" class="flex flex-col pb-4">
                  <span class="pb-1">Confirm Password: </span>
                  <input type="password" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="password_confirmation" value="{{old('password_confirmation')}}" required>
                </label>
                <div class="flex flex-col gap-2">
                  <input class="px-10 pb-2 h-10 flex items-center justify-center bg-second w-full cursor-pointer" type="submit" value="Sign Up">
                 <span class="text-sm">Already have an account? <a href="{{asset('/login')}}" class="text-blue-500">Login</a></span>
                </div>
              </form>
        </div> </div>   

</x-layout>