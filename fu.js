
'use strict';

function checkOther(selectObj) {
    // get the index of the "Other" option
    var otherIndex = selectObj.options.length - 1;
    // check if the "Other" option has been selected
    if (selectObj.selectedIndex == otherIndex) {
        // unhide the input field
        document.getElementById("other_field").style.display = "block";
    } else {
        // hide the input field
        document.getElementById("other_field").style.display = "none";
    }
}

function handleImageUpload1() {
        const imageInput = document.getElementById('imageInput1');
        const file = imageInput.files[0];

        if (!file) {
            alert('Please select an image.');
            return;
        }

        // Read EXIF data from the image
        EXIF.getData(file, function() {
            const latitude = EXIF.getTag(this, 'GPSLatitude');
            const longitude = EXIF.getTag(this, 'GPSLongitude');

            if (latitude && longitude) {
                console.log(`Geotag: Latitude ${latitude}, Longitude ${longitude}`);
                // Store the location or perform further actions
            } else {
                alert('This image does not have valid geotag information.');
            }
        });
    }

    function handleImageUpload() {
        const imageInput = document.getElementById('imageInput');
        const file = imageInput.files[0];

        if (!file) {
            alert('Please select an image.');
            return;
        }

        // Read EXIF data from the image
        EXIF.getData(file, function() {
            const latitude = EXIF.getTag(this, 'GPSLatitude');
            const longitude = EXIF.getTag(this, 'GPSLongitude');

            if (latitude && longitude) {
                console.log(`Geotag: Latitude ${latitude}, Longitude ${longitude}`);
                // Store the location or perform further actions
            } else {
                alert('This image does not have valid geotag information.');
            }
        });
    }

        function quickForms(){
            const loginForm = document.querySelector('.quick-form');
            const registerForm = document.querySelector('.detailed-form');
            loginForm.style.display = 'block';
            registerForm.style.display = 'none'
        }

        function detailedForms(){
            const loginForm = document.querySelector('.quick-form');
            const registerForm = document.querySelector('.detailed-form');
            loginForm.style.display = 'none';
            registerForm.style.display = 'block'   
        }
    