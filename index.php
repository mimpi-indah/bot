<!DOCTYPE html>
<html>
<head>
    <title>Random Directory File Uploader</title>
</head>
<body>

<?php
function generateRandomDirName($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $dirName = '';
    for ($i = 0; $i < $length; $i++) {
        $dirName .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $dirName;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $randomDir = generateRandomDirName();
    $targetDir = "uploadss/" . $randomDir . "/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        $fileUrl = $targetFile;
        echo "Congratulations, your file has been uploaded to a random directory! Here's the URL: <a href='$fileUrl'>$fileUrl</a>";
    } else {
        echo "Oops, something went wrong during the upload.";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    Select your worthy file:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload to Random Directory" name="submit">
</form>

</body>
</html>
