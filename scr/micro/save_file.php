<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitButton"])) {
    $fileName = $_POST["fileName"];
    $fileExtension = $_POST["chon"];
    $fileName = preg_replace("/[^a-zA-Z0-9_-]/", "", $fileName);
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . $fileName . $fileExtension;
    if (rename('output.wav', $filePath)) {
        echo "Lưu thành công";
    } else {
        echo "Lỗi khi lưu file";
    }
}
?>
