<x-layout>
  <style>
    .show {
      display: flex;
    }
  </style>
  <link rel="stylesheet" href="{{asset('/ijaboCropTool/ijaboCropTool.min.css')}}">
  <div class="min-h-screen">
    <x-settings-profile />

    <x-settings-account />

    <x-settings-password />
  </div>
  
</x-layout>

<script>
  var ProfileSelector = document.querySelector("#ProfileSelector");
  var ProfileBtn = document.querySelector("#ProfileBtn");

  ProfileBtn.addEventListener("click", (e) => {
      e.preventDefault();
    ProfileSelector.click();
  });
  
</script>
<script>
  var GenderListToggle = document.querySelector("#GenderListToggle");
  var GenderList = document.querySelector("#GenderList");

  if (GenderListToggle != null) {
    GenderListToggle.addEventListener("click", function () {
      if (GenderList.classList.contains("hidden")) {
        GenderList.classList.remove("hidden");
      } else {
        GenderList.classList.add("hidden");
      }
    });
  }

  
  $('.gender').on('click', function(e) {
    e.preventDefault();
    var value = $(this).attr('data-gender');
    $('#GenderListToggle').attr('value' , value)
    GenderList.classList.add("hidden");
  })

</script>
<script>
  var currentSearchString = window.location.search;
  if (currentSearchString == '?section=profile') {
    settings_Profile_Toggle.click();
  }else if(currentSearchString == '?section=account'){
    settings_Account_Toggle.click();
  }else if (currentSearchString == '?section=password') {
    settings_Password_Toggle.click();
  }
</script>
<script src="{{asset('/ijaboCropTool/ijaboCropTool.min.js')}}"></script>
<script> 
  $('#ProfileSelector').ijaboCropTool({
    preview: '.profile_image',
    processUrl: '{{ route("crop") }}',
    allowedExtensions: ['jpg', 'jpeg','png'],
    withCSRF:['_token','{{ csrf_token() }}'],

    onSuccess:function(message, element, status){
      $('#profileError').remove();
      $('#avatar_title').append(`<p class="text-sm text-second" id='profileError'>`+ message +`</p>`);
    },
   onError:function(message, element, status){
      $('#profileError').remove();
      $('#avatar_title').append(`<p class="text-sm text-red-500" id='profileError'>`+ message +`</p>`);
   }
  })
</script>