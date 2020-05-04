<?php
$imageDir = 'uploads/';

if(!empty($_POST))
{
    foreach ($_POST as $image => $value) {
        if (isset($image)) {
            $imageToDelete = str_replace("_", ".", $image);
            $imageToDeletePath = $imageDir . $imageToDelete;
            if (file_exists ( $imageToDeletePath )) {
                unlink($imageToDeletePath);
            }
            $_POST = array();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laisse pas traîner ton File</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="images[]" multiple id="imageUpload" />
        <button>Send</button>
    </form>
    <p><em><u>* CAUTION : Deleting an image is a non reversible decision ! *</u></em></p>
    <?php
    $iterator = new FilesystemIterator($imageDir);
    foreach ($iterator as $image) {
        $imageName = $image->getFilename();
        $imagePath = $imageDir . $imageName;
        echo "<figure>
                <img src=\"$imagePath\" alt='$imageName' height='48px'>
                <figcaption>$imageName</figcaption>
              </figure>
              <form method=\"POST\">
                <input name=\"$imageName\" type=\"submit\" value=\"Delete ? \">
              </form>";
    }
    ?>
</body>
</html>