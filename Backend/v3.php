<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

$uploadDirectory = __DIR__ . '/priv-uploads/';
$keysFile = __DIR__ . '/keys.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $fileHash = sha1_file($file['tmp_name']);
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $fileHash . '.' . $extension;
    $uploadFilePath = $uploadDirectory . $newFileName;
    $key = bin2hex(random_bytes(16));

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        $keys = [];
        if (file_exists($keysFile)) {
            $keys = json_decode(file_get_contents($keysFile), true);
        }
        $keys[$newFileName] = $key;
        file_put_contents($keysFile, json_encode($keys));

        $fileUrl = 'https://api-upload-filer-v2.glitch.me/v3.php?file=' . $newFileName . '&key=' . $key;
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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['file']) && isset($_GET['key'])) {
    $file = $_GET['file'];
    $key = $_GET['key'];

    if (file_exists($keysFile)) {
        $keys = json_decode(file_get_contents($keysFile), true);
        if (isset($keys[$file]) && $keys[$file] === $key) {
            $filePath = $uploadDirectory . $file;
            if (file_exists($filePath)) {
                header('Content-Type: ' . mime_content_type($filePath));
                readfile($filePath);
                exit;
            } else {
                echo 'File not found.';
            }
        } else {
            echo 'Sorry, invalid key.';
        }
    } else {
        echo 'Sorry, invalid key.';
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request. To upload, visit https://file-uploader-v1.glitch.me/v3.html'
    ]);
}
?>
