<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDirectory = __DIR__ . '/upload/';
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $uploadFilePath = $uploadDirectory . $fileName;

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        $fileUrl = 'https://api-upload-filer-v2.glitch.me/upload/' . $fileName;
        echo json_encode([
            'status' => 'success',
            'url' => $fileUrl
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to upload file.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No file uploaded.'
    ]);
}
?>
