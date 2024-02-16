//FOR LOADER

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('edit-product-form');

    form.addEventListener('submit', function () {
        // Show the loader when the form is submitted
        $('#loader-container').css('display', 'block');

    });
});

// PRODUCT EDIT SCRIPT ADMIN AND VENDOR BOTH START


// Event delegation for plus buttons
$("#duplicated-container").on("click", "#add-variation", function () {
    var clone = $(".form-group.variation-box:first").clone(true);

    // Clear the color picker and the associated input field
    clone.find("input[type=color]").val("#000000");
    clone.find("#colorCode").val("");
    clone.find("#colorCode").val("").css('background-color', 'transparent');

    clone.find("input[type=color]").val(""); // Clear color input
    clone.find("input[type=number]").val(""); // Clear price input
    clone.find("#minus-variation").show(); // Show the minus button for the new duplicate
    clone.find("#add-variation").hide(); // Hide the plus button on the current clone
    $("#duplicated-container").append(clone);
});

// Event delegation for minus buttons
$("#duplicated-container").on("click", "#minus-variation", function () {
    $(this).closest(".form-group.variation-box").remove();
});

// Event delegation for color picker inputs
$("#duplicated-container").on("change", "input[type=color]", function () {
    // Get the selected color value
    const selectedColor = $(this).val();

    // Find the associated color code input field within the same form group
    const clonedColorCodeInput = $(this).closest(".form-group.variation-box").find("#colorCode");
    clonedColorCodeInput.css('background-color', selectedColor);
    clonedColorCodeInput.val(selectedColor);
});

// For set product Gallery
//APPEND SELECTED DELETE MEDIA ID SO I CAN DELETE THIS GALLERY IMAGES FROM CONTROLLER
$(document).on('click', '.gallery-img-cross', function () {

    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
    console.log("id", id)
    $('#edit-product-form').append('<input type="hidden" name="delete_gall_media_ids[]" id="galval' + id + '" class="removegal" value="' + id + '">')

});

$(document).on('click', '#prod_gallery', function () {
    $('#uploadgallery').click();
});


$("#uploadgallery").change(function () {
    var total_file = document.getElementById("uploadgallery").files.length;
    for (var i = 0; i < total_file; i++) {
        $('.selected-image .row').append('<div class="col-sm-6">' +
            '<div class="img gallery-img">' +
            '<span class="gallery-img-cross"><i class="fas fa-times"></i>' +
            '<input type="hidden" value="' + i + '">' +
            '</span>' +
            '<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
            '<img src="' + URL.createObjectURL(event.target.files[i]) + '"  class="gallery-image" alt="gallery image">' +
            '</a>' +
            '</div>' +
            '</div> '
        );
    }

});

// For show and hide checkbox inner box's
$(".checkclick1").on("change", function () {
    if (this.checked) {
        $(this).parent().parent().parent().next().removeClass('show-box');
    } else {
        $(this).parent().parent().parent().next().addClass('show-box');
    }
});


//FOR PRODUCT FEATURE IMAGE PREVIEW
let uploadButton = document.getElementById("crop-image");
const fileInput = document.getElementById("file-input");
const featurePhoto = document.getElementById("feature_photo");
const imagePreview = document.getElementById("image-preview");

uploadButton.addEventListener("click", function () {
    fileInput.click();
});

fileInput.addEventListener("change", function () {
    if (fileInput.files.length > 0) {
        const selectedImage = fileInput.files[0];
        featurePhoto.value = selectedImage.name;  // Set the filename in the hidden input
        imagePreview.style.display = "block"; // Show the image preview
        imagePreview.src = URL.createObjectURL(selectedImage); // Set the preview image source

    } else {
        imagePreview.style.display = "none"; // Hide the image preview if no image is selected

    }
});


// PRODUCT EDIT SCRIPT ADMIN AND VENDOR BOTH END
