function previewProfilePic(input) {
    const preview = document.getElementById('profilePicPreview');
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}