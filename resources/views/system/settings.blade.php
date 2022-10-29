<x-layout>
  <style>
    .show {
      display: flex;
    }
  </style>
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

  ProfileSelector.addEventListener("change", function() {
    var file = this.files[0];
    if (file) {
      if (isFileImage(file)) {
        var reader = new FileReader();
        reader.addEventListener("load", function () {
          Porofilemage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
      }
    }
  });
  function isFileImage(file) {
    const acceptedImageTypes = ["image/gif", "image/jpeg", "image/png"];

    return file && acceptedImageTypes.includes(file["type"]);
  }
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