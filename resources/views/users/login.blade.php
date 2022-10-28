<x-layout>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="w-72 bg-dark-400 pt-3 pb-4 px-2 rounded sm:w-96 m-auto" >
            <form class="px-2 flex flex-col" method="POST" action="/user/authenticate" >
                @csrf
                <h1 class="text-center text-4xl pb-4">Login</h1>
                <label for="" class="flex flex-col gap-1 pb-4">
                  <span class="">Email: </span>
                  @error('email')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror 
                  <input type="email" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="email" value="{{old('Email')}}" required>
                </label>
                <label for="" class="flex flex-col pb-4">
                  @error('password')
                    <p class="text-sm text-red-500">{{$message}}</p>
                  @enderror 
                  <span class="pb-1">Password: </span>
                  <input type="password" class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 " name="password" value="{{old('Password')}}" required>
                </label>
                <div class="flex flex-col gap-2">
                  <input class="px-10 h-10 flex items-center justify-center bg-second w-full cursor-pointer" type="submit" value="Login">
                 <span class="text-sm">Don't have an account? <a href="{{asset('/register')}}" class="text-blue-500 pt-2" >Sign up</a></span>
                </div>
              </form>
        </div> 
    </div>   
</x-layout>