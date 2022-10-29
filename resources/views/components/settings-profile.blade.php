<div
      class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 py-3 bg-dark-300 px-3 md:px-5"
    >
      <form action="#" class="flex flex-col gap-2">
        <a class="text-2xl md:text-3xl font-bold h-12 flex items-center" id="settings-Profile-Toggle" href="#">Profile <i class="fa-solid fa-angle-up ml-auto transform" id="settings-Profile-cursor"></i></a>
        <div class="hidden flex-col gap-2" id="settings-Profile">
          <span class="font-bold">Avatar</span>
        <div class="w-full h-32 flex items-center gap-2 md:gap-4" id="SettingsProfile">
          <img
            src="{{asset('/image/profile.jpg')}}"
            alt="profile Image"
            class="w-24 h-24 rounded-full"
            id="Porofilemage"
          />
          <a
            href="#"
            class="px-4 flex items-center justify-center bg-second h-10 rounded-lg"
            id="ProfileBtn"
            >Change</a
          >
          <a
            href="#"
            class="px-4 flex items-center justify-center bg-red-500 h-10 rounded-lg"
            >Delete</a
          >
          <input
            type="file"
            name="imageInput"
            id="ProfileSelector"
            class="absolute invisible"
            accept="image/jpeg, image/jpg, image/png"
          />
        </div>
        <span class="font-bold">Full name</span>
        <input
          type="text"
          value="{{auth()->user()->name}}"
          class="w-full h-10 bg-transparent border border-gray-400 border-opacity-30 px-3 outline-none"
        />
        <span class="font-bold">Gender</span>
        <div
          class="relative w-full h-10 rounded border border-gray-400 border-opacity-30"
        >
        <input type="text" readonly id="GenderListToggle" class="h-full w-full flex items-center px-3 bg-transparent cursor-pointer outline-none" value="Select Gender...">
        <i class="fa-solid fa-angle-down absolute right-2.5 top-2.5"></i>
          <div
            class="w-full py-1 absolute mt-1 bg-dark-500 hidden"
            id="GenderList"
          >
            <ul>
              <li>
                <p
                  class="w-full h-10 flex items-center px-3 "
                  >Select Gender...</p
                >
              </li>
              <li>
                <a
                  href="#"
                  class="w-full h-10 flex items-center px-3 hover:bg-dark-300 gender"
                  data-gender="Male"
                  >Male</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="w-full h-10 flex items-center px-3 hover:bg-dark-300 gender"
                  data-gender="Female"
                  >Female</a
                >
              </li>
            </ul>
          </div>
        </div>
        <span class="font-bold">Birthday</span>
        <div class="w-full h-10 flex justify-between gap-1 sm:gap-2">
          <input
            type="text"
            placeholder="YYYY"
            class="text-center outline-none border border-gray-400 border-opacity-30 bg-transparent w-2/5"
          />
          <input
            type="text"
            placeholder="MM"
            class="text-center outline-none border border-gray-400 border-opacity-30 bg-transparent w-2/6"
          />
          <input
            type="text"
            placeholder="DD"
            class="text-center outline-none border border-gray-400 border-opacity-30 bg-transparent w-2/6"
          />
        </div>
        <span class="font-bold">About</span>
        <textarea
          name=""
          id=""
          class="outline-none border border-gray-400 border-opacity-30 bg-transparent resize-none w-full h-36 p-2"
        >
My Amine Collection</textarea
        >
        <a
          href="#"
          class="px-10 h-10 flex items-center justify-center bg-second"
          >Save Changes</a
        >
        </div>
      </form>
    </div>