document.addEventListener("DOMContentLoaded", function() {
    const videoPlayer = document.getElementById("video-player");
    const videoUploadForm = document.getElementById("video-upload-form");
    const videoFileInput = document.getElementById("video-file");

    videoUploadForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData();
        formData.append("video", videoFileInput.files[0]);

        fetch("upload.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadVideo(data.videoPath);
            } else {
                alert("Video upload failed.");
            }
        })
        .catch(error => console.error(error));
    });

    function loadVideo(videoPath) {
        videoPlayer.src = videoPath;
        videoPlayer.load();
        videoPlayer.play();
    }
});
