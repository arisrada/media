<?php
$uploadDir = "uploads/";
$allowedExtensions = ["mp4", "avi", "mov"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["video"])) {
    $videoFile = $_FILES["video"];
    $extension = pathinfo($videoFile["name"], PATHINFO_EXTENSION);
    
    if (in_array(strtolower($extension), $allowedExtensions)) {
        $videoPath = $uploadDir . uniqid() . "." . $extension;
        
        if (move_uploaded_file($videoFile["tmp_name"], $videoPath)) {
            echo json_encode(["success" => true, "videoPath" => $videoPath]);
        } else {
            echo json_encode(["success" => false]);
        }
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}
?>
