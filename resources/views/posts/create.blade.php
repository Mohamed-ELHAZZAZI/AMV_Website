<x-layout>
    <div class="w-11/12 md:w-4/5 max-w-2xl mx-auto mt-3 mb-5">
        <div class="w-72 bg-dark-300 mb-6">
          <a
            href="#"
            class="h-10 w-full flex items-center justify-between px-3"
            id="RulesBoxToggle"
            ><span>Posting Rules</span>
            <i
              class="fa-solid fa-angle-up transform rotate-180"
              id="RulesBoxAngle"
            ></i
          ></a>
          <div class="w-full px-7 text-sm bg-dark-300" id="RulesBox">
            <ol class="list-decimal">
              <li class="h-8 px-1">No pornography</li>
              <li class="h-8 px-1">No violence or gory contents</li>
              <li class="h-8 px-1">No hate speech and bullying</li>
              <li class="h-8 px-1">No spamming and manipulation</li>
              <li class="h-8 px-1">No deceptive content</li>
              <li class="h-8 px-1">No illegal activities</li>
              <li class="h-8 px-1">No impersonation</li>
              <li class="h-8 px-1">No copyright infringement</li>
            </ol>
          </div>
        </div>
        <div class="w-full gap-5 flex flex-col">
          <h1 class="font-bold text-4xl">Upload Post</h1>
          <form action="/posts/store" id="postForm" method="POST" class="w-full h-full flex flex-col gap-5" enctype="multipart/form-data">
            @csrf
            <div class="w-full gap-3 flex flex-col" id="formContent">
              <ul id="PostErrors"></ul>
              <div
              class="w-full h-12 border border-gray-400 border-opacity-50 relative flex"
            >
              <input
                type="text"
                placeholder="Title"
                class="w-full outline-none pl-3 pr-12 rounded bg-transparent border-0"
                id="PostTitle"
                name="title"
                value="{{old('title')}}"
              />
              <span class="absolute right-2.5 top-2.5" id="TitleMaxLength">280</span>
            </div>
            <div
              class="w-full min-h-72 bg-black border rounded border-gray-400 border-opacity-50 relative"
            >
              <a
                href="#"
                class="w-10 h-10 bg-second items-center justify-center text-lg absolute top-2 right-4 rounded-full z-10 hidden"
                id="RestoreMedia"
                ><i class="fa-solid fa-x"></i
              ></a>
              <img src="" alt="" class="mx-auto hidden" id="FileImage" />
              <video class="mx-auto hidden" controls id="FileVideo">
                <source src="" id="VideoSource" />
              </video>
              <div
                class="w-full min-h-full flex items-center justify-center gap-5 flex-col py-5"
                id="uploadFile"
              >
                <i class="fa-solid fa-image text-9xl"></i>
                <span>Choose image or video to upload</span>
                <button
                  class="w-28 h-10 bg-second rounded"
                  id="FileInputBtn"
                  type="button"
                >
                  Choose file
                </button>
                <input
                  type="file"
                  name="media"
                  id="PostFileInput"
                  class="invisible absolute"
                  accept="image/jpeg, image/jpg, image/png, image/gif, video/mp4, video/webm, video/quicktime, video/x-m4v"
                />
              </div>
            </div>
            <div
              class="w-full min-h-12 p-3 py-2 rounded border border-gray-400 border-opacity-50 bg-transparent flex items-center gap-2 flex-wrap"
              id="tags"
            >
            <div class="flex gap-2" id="tags-container"></div>
              <input
                type="text"
                placeholder="+ Add Tag"
                class="h-full bg-transparent outline-none border-0 focus:outline-none"
                id="TagsInput"
              />
              <input type = 'hidden' value = '' name='tags' id="tags-input-value">
            </div>
            </div>
            <input type="submit" value="Submit post" class="w-full h-10 bg-second rounded cursor-pointer hover:bg-opacity-90" name="submit" id="submit">
          </form>
        </div>
      </div>
      <script>
        function setError(error) {
          $('#PostErrors').append('<li class="text-red-500">'+ error + '</li>');
          var topOfDiv = document.getElementById("postForm").offsetTop;
          window.scrollTo({ top: topOfDiv - 100, behavior: 'smooth' });
        }

        
        $(document).ready(function() {
          var formContent = $('#formContent');
          var submitionBTN = $('#submit');
          $('#postForm').on('submit', function(e) {
            e.preventDefault()
            document.getElementById("PostErrors").innerHTML = "";

            if ($('#PostTitle').val().length == 0) {
              return setError('The title field is required.')
            }else if($('#PostTitle').val().length > 280) {
              return setError('The title must not be greater than 280 characters.')
            }

            if (tagsARRAY.length > 5) {
              return setError('Only 5 tags are acceptable');
            }

            if (!$('#PostFileInput').val().match(/\.(jpg|jpeg|gif|png|mp4|webm|quicktime|x-m4v)$/)){
              return setError('Invalide file format');
            } 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = this;
            
            $.ajax({
              url:$(form).attr('action'),
              method: $(form).attr('method'),
              data: new FormData(form),
              dataType: "json",
              contentType: false,
              processData: false,
              beforeSend: function () {

                formContent.addClass('blur-sm -z-50');
                submitionBTN.val('publishing in a sec ...')

              },
              success: function (response) {
                if (response.status == 400) {

                  formContent.removeClass('blur-sm -z-50');
                  submitionBTN.val('Submit post')
                  
                  
                  $.each(response.errors, function (key, error_value) {
                    setError(error_value);
                  })
                }else {
                  setError(response.message);
                  window.location.href = '/';
                }
              },
              
            })

          })
        })
      </script>
      <script>

        var tagsARRAY=[];

        function setTag(tag, index) {
          return `<span class="h-9 px-2 bg-dark-400 flex items-center justify-center rounded-lg gap-2 " data-index= '`+ index + `'>
                ` +
                  tag +
                  `<i class="fa-solid fa-x text-xs cursor-pointer close"></i>
              </span>`;
        }

        $("#TagsInput").keypress(function (event) {
          var key = event.which;
          if (key == 13 || key == 44) {
            event.preventDefault();
            var tag = $(this).val();
            if (tag.length > 0) {

              $('#tags-container').append(setTag(tag, tagsARRAY.length));
              
              tagsARRAY.push(tag);


              $('#tags-input-value').val(tagsARRAY.join(','));

              $(this).val("");

              if (tagsARRAY.length > 4) {
                $("#TagsInput").hide();
              }
            }
          }
        });
  

        $("#tags").on("click", ".close", function (e) {
         
          var Dtag = $(this).parent("span").attr('data-index');
          var newTagARRAY = tagsARRAY;
          var minus = 0
          tagsARRAY = [];
          for (let index = 0; index < newTagARRAY.length - 1; index++) {
            if (index == Dtag) {
              minus = 1;
            }
            tagsARRAY[index] = newTagARRAY[index + minus];
          }
          
          document.getElementById("tags-container").innerHTML = "";

          
          var index = 0;
          tagsARRAY.forEach(tag => {
            $('#tags-container').append(setTag(tag , index));
            index++;
          });

          $('#tags-input-value').val(tagsARRAY.join(','));
          
          $("#TagsInput").show();
        });
      </script>
  
      <script>
        $("#PostTitle").keydown(function (e) {
          var TitleValue = $(this).val().length + 1;
          $('#TitleMaxLength').text(280 - TitleValue)
          if (TitleValue >= 280) {
            $(this).addClass('text-red-500');
          }else {
            $(this).removeClass('text-red-500');
          }
        });
      </script>

      {{-- --}}

      <script>
        $(document).on("keydown", ":input:not('#TagsInput')", function(event) {
          return event.key != "Enter";
        });

      </script>
</x-layout>