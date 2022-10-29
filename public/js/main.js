var POSTS = document.querySelectorAll(".POSTS")[0];
if (POSTS != null) {
    POSTS.classList.remove("border-t");
}

var searchFormToggle = document.querySelector("#searchFormToggle");
var searchForm = document.querySelector("#searchForm");

var profileListToggle = document.querySelector("#profileListToggle");
var profileList = document.querySelector("#profileList");

var NavListToggle = document.querySelector("#NavListToggle");
var NavList = document.querySelector("#NavList");

if (searchFormToggle != null) {
    searchFormToggle.addEventListener("click", (e) => {
        e.preventDefault();
        profileList.classList.replace("block", "hidden");
        if (searchForm.classList.contains("hidden")) {
            searchForm.classList.replace("hidden", "block");
        } else {
            searchForm.classList.replace("block", "hidden");
        }
    });
}

if (profileListToggle != null) {
    profileListToggle.addEventListener("click", (e) => {
        e.preventDefault();
        searchForm.classList.replace("block", "hidden");
        if (profileList.classList.contains("hidden")) {
            profileList.classList.replace("hidden", "block");
        } else {
            profileList.classList.replace("block", "hidden");
        }
    });
}

if (NavListToggle != null) {
    NavListToggle.addEventListener("click", (e) => {
        e.preventDefault();
        if (NavList.classList.contains("hidden")) {
            NavList.classList.remove("hidden");
        } else {
            NavList.classList.add("hidden");
        }
    });
}
document.addEventListener("click", (event) => {
    if (
        event.target.closest("#profileList") ||
        event.target.closest("#searchForm") ||
        event.target.closest("a")
    )
        return;
    profileList.classList.replace("block", "hidden");
    searchForm.classList.replace("block", "hidden");
});

/////////////////////////////////
/////////////////////////////////
////////////////////////////////
//Submit
////////////////////////////////
////////////////////////////////
////////////////////////////////

var RulesBoxToggle = document.querySelector("#RulesBoxToggle");
var RulesBox = document.querySelector("#RulesBox");
var RulesBoxAngle = document.querySelector("#RulesBoxAngle");

if (RulesBoxToggle != null) {
    RulesBoxToggle.addEventListener("click", (e) => {
        e.preventDefault();
        if (RulesBox.classList.contains("hidden")) {
            RulesBox.classList.remove("hidden");
            RulesBoxAngle.classList.replace("rotate-0", "rotate-180");
        } else {
            RulesBox.classList.add("hidden");
            RulesBoxAngle.classList.replace("rotate-180", "rotate-0");
        }
    });
}

var FileInputBtn = document.querySelector("#FileInputBtn");
var PostFileInput = document.querySelector("#PostFileInput");

if (FileInputBtn != null) {
    FileInputBtn.addEventListener("click", (e) => {
        PostFileInput.click();
    });
}

/////////////////////////////////
/////////////////////////////////
////////////////////////////////
//Submit -> media display
////////////////////////////////
////////////////////////////////
////////////////////////////////

var uploadFile = document.querySelector("#uploadFile");
var FileImage = document.querySelector("#FileImage");
var VideoSource = document.querySelector("#VideoSource");

var PostFileInput = document.querySelector("#PostFileInput");
var PostImage = document.querySelector("#FileImage");
var PostVideo = document.querySelector("#FileVideo");

var RestoreMedia = document.querySelector("#RestoreMedia");

if (PostFileInput != null) {
    PostFileInput.addEventListener("change", function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            if (isFileImage(file)) {
                uploadFile.classList.add("hidden");
                FileVideo.classList.add("hidden");
                FileImage.classList.remove("hidden");

                reader.addEventListener("load", function () {
                    PostImage.setAttribute("src", this.result);
                    RestoreMedia.classList.replace("hidden", "flex");
                });
                reader.readAsDataURL(file);
            } else if (isFileVideo(file)) {
                uploadFile.classList.add("hidden");
                FileImage.classList.add("hidden");
                FileVideo.classList.remove("hidden");

                reader.addEventListener("load", function () {
                    FileVideo.setAttribute("src", this.result);
                    RestoreMedia.classList.replace("hidden", "flex");
                });
                reader.readAsDataURL(file);
            }
        }
    });

    //restaure uploading input and removing the media

    RestoreMedia.addEventListener("click", (e) => {
        e.preventDefault();

        FileImage.setAttribute("src", "");
        FileVideo.setAttribute("src", "");

        FileImage.classList.add("hidden");
        FileVideo.classList.add("hidden");

        uploadFile.classList.remove("hidden");
        PostFileInput.value = "";

        RestoreMedia.classList.replace("flex", "hidden");
    });
}

function isFileImage(file) {
    const acceptedImageTypes = ["image/gif", "image/jpeg", "image/png"];

    return file && acceptedImageTypes.includes(file["type"]);
}

function isFileVideo(file) {
    const acceptedImageTypes = [
        "video/mp4",
        "video/webm",
        "video/quicktime",
        "video/x-m4v",
    ];

    return file && acceptedImageTypes.includes(file["type"]);
}

//////////////////////
///////////////////////
//////Settings
///////////////////////
///////////////////////
function showSection(section , cursor) {
    section.classList.toggle('show');
    cursor.classList.toggle('rotate-180');
}


var settings_Profile_Toggle = document.querySelector(
    "#settings-Profile-Toggle"
);
var settings_Profile = document.querySelector("#settings-Profile");
var settings_Profile_cursor = document.querySelector(
    "#settings-Profile-cursor"
);

if (settings_Profile_Toggle != null) {
    settings_Profile_Toggle.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(settings_Profile , settings_Profile_cursor)
    });
}


var settings_Account_cursor = document.querySelector("#setting-account-cursor");
var settings_Account_Toggle = document.querySelector("#setting-account-toggle");
var settings_Account = document.querySelector("#setting-account");

if (settings_Account_Toggle != null) {
    settings_Account_Toggle.addEventListener('click' ,function(e) {
        e.preventDefault();
        showSection(settings_Account , settings_Account_cursor)
    })
}


var settings_Password_cursor = document.querySelector("#setting-password-cursor");
var settings_Password_Toggle = document.querySelector("#setting-password-toggle");
var settings_Password = document.querySelector("#setting-password");

if (settings_Password_Toggle != null) {
    settings_Password_Toggle.addEventListener('click' ,function(e) {
        e.preventDefault();
        showSection(settings_Password , settings_Password_cursor)
    })
}
