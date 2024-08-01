// or via CommonJS

// or via CommonJS

var FileManagement = {
    baseUrl: "http://localhost/dorch/dashboard/document/delete",
    baseUrldwn: "http://localhost/dorch/dashboard/document/download-file",
    baseUrlupload: "http://localhost/dorch/dashboard/document/upload",
    mainSelector: "#fullpage",
    mutlifile_Input_id: "#pop",
    progressBarContainer_id: "#progressBarsContainer",

    init: function () {},
    uploadFiles: function () {
        var fileInput = $(FileManagement.mutlifile_Input_id)[0];
        var files = fileInput.files;
        var finishidFiles = 0;
        for (var i = 0; i < files.length; i++) {
            $("#progress").removeClass("hide");

            // var allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf', '.svg', '.zip', '.docx', '.xlsx','.txt'];
            // var fileExtension = files[i].name
            //     .substring(files[i].name.lastIndexOf("."))
            //     .toLowerCase();

            // if (allowedExtensions.includes(fileExtension)) {
            FileManagement.uploadFile(files[i]);
            finishidFiles++;
            if (finishidFiles == files.length) {
                $("#doneButton").show();
            }

            // } else {

            //     toastr.error('Invalid file type:'+fileExtension, 'Failed to Upload');

            // }
        }
    },
    uploadFile: function (file) {
        var formData = new FormData();
        formData.append("file", file);

        var progressBarContainer = $('<div class="prog-container"></div>');
        var trimmedName = file.name.substring(0, 10);
        var displayFileName =
            trimmedName + (file.name.length > 10 ? "..." : "");
        var fileName = $(
            '<div class="file-name">' + displayFileName + "</div>"
        );
        progressBarContainer.append(fileName);

        var progBar = $(
            '<div class="prog-bar" id="progBar_' + file.name + '"></div>'
        );
        progressBarContainer.append(progBar);

        var newRow = $("<tr></tr>");
        newRow.append("<td></td>").append("<td></td>");
        newRow.find("td:first-child").append(fileName);
        newRow.find("td:nth-child(2)").append(progressBarContainer);

        $(FileManagement.progressBarContainer_id).append(newRow);

        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", function (event) {
            if (event.lengthComputable) {
                var percent = Math.round((event.loaded / event.total) * 100);
                progBar.width(percent + "%").html(percent + "%");
            }
        });

        xhr.addEventListener("load", function (event) {
            var uploadStatus = $("#uploadStatus");
            uploadStatus.html(event.target.responseText);
            $("#fileUpload").val("");
        });
        xhr.open("POST", FileManagement.baseUrlupload, true);
        xhr.send(formData);
    },

    getPics: function (i) {
        var img = $("#imgpath" + i).attr('file-path');
        var fullPage = $("#fullpage");
        var imagepath= "http://localhost/dorch/storage/app/public/" + img;
        fullPage.css("background-image", "url(" + imagepath + ")");
        fullPage.css("display", "block");
    },
    toggleCheck: function (Id) {
        var selectedImage = []; // Array to store selected images for this specific click event
        var filespath = [];

        // Deselect all other images/cards if Ctrl key is not pressed
        if (!event || !event.ctrlKey) {
            $("#container_cards .cardimg").removeClass("blue-box");
        }

        // Toggle the blue-box class for the clicked card
        $("#container_cards #card" + Id).toggleClass("blue-box");

        $(".cardimg").each(function () {
            var cardId = this.id.slice(4);
            var isSelected = $("#container_cards #card" + cardId).hasClass(
                "blue-box"
            );
            $("#container_cards #card" + cardId + " i.fa-check").css(
                "visibility",
                isSelected ? "visible" : "hidden"
            );
        });
        var selectedImages = $(".cardimg.blue-box");
        var selectedCount = selectedImages.length;

        // Enable or disable based on the number of selected images
        $("#download, #delete, #nwname, #view").attr("disabled", "disabled");

        if (selectedCount === 1) {
            $("#download, #delete, #nwname, #view").removeAttr("disabled");
            toastr.info(
                "Press Ctrl+click to select multiple Images",
                "MutltiSelect",
                { timeOut: 3000 }
            );
        } else if (selectedCount > 1) {
            $("#nwname, #view").attr("disabled", "disabled");
            $("#delete, #download").removeAttr("disabled");
        }
        // Update the selectedImages array based on whether the image is already selected or not
        $(".blue-box").each(function () {
            var imageId = this.id.slice(4);
            var fileId = $("#delete" + imageId).attr("value");
            var filepath =$("#delete"+imageId).attr("file-path");

            var fileonly = filepath.split('/');
            selectedImage.push(fileId);
            filespath.push(fileonly[1]);
        });

        // Construct the URL using the last image in the array
        var deleteUrl = FileManagement.baseUrl + "/" + selectedImage;
        var downlink = FileManagement.baseUrldwn + "/" + filespath;
        var imgname = $("#delete" + Id).attr("file-path");
        var valimg = imgname.split("/");
        var imgurl = "http://localhost/dorch//storage/app/public/" + imgname;

        // Update the href attribute using jQuery
        $("#delete").attr("href", function () {
            return selectedImage.length > 0 ? deleteUrl : "";
        });
        $("#download").attr("href", function () {
            if (selectedImages.length > 1) {
                $("#download").removeAttr("download");
                return downlink;
            } else if (selectedImages.length > 0) {
                $("#download").removeAttr("disabled");
                $("#download").attr("download", valimg[1]);
                return imgurl;
            } else {
                $("#download").removeAttr("download");
                return "";
            }
        });

        // Toggle the href attribute of the view link
        $("#view").attr("href", function () {
            return $(this).attr("href") ===
                "javascript:FileManagement.getPics(" + Id + ")"
                ? "javascript:FileManagement.getPics()"
                : "javascript:FileManagement.getPics(" + Id + ")";
        });
        var image = $("#delete" + Id).attr("value");
        // Toggle the values of input fields
        $("#imagenew").attr('value',image);
        var FileOldName = $('.file-old-name'+Id).attr('file-old-name')
        $("#namec").attr('value',FileOldName);

        // Prevent default browser behavior when using Ctrl key for multiple selections
        if (event && event.ctrlKey) {
            event.preventDefault();
        }
    },

    
};
$(document).ready(function () {
    $("#multifiles").on("change", "#pop", function () {
        $("#popup").show();
        $(".close_pop").show();
        FileManagement.uploadFiles();
    });

    $(".close_pop").click(function () {
        $("#popup").hide();
        $(".close_pop").hide();
        $("#progressBarsContainer").empty();
        // Instead of removing, just clear the value of the file input
        $("#upload-form")[0].reset();

        // If you need to reset the form, you can do it like this:
        // $('#upload-form')[0].reset();
    });

    FileManagement.init();
});
