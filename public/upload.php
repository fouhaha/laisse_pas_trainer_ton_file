<?php

if(!empty($_FILES['images']['name'][0]))
{
    $images = $_FILES['images'];

    $imageDirectory = 'uploads/';
/*//////////////////////////////// varray $upload not used here ///////////////////////////////*/
/*    $uploaded = [];   */
/*//////////////////////////////// varray $failed not used here ///////////////////////////////*/
/*    $failed = [];     */
    $imageMaxSize = 1000000;
    $allowedTypes = ['.jpg', '.png', '.gif'];

    foreach($images['name'] as $position => $imageName) {
        $imageTmp = $images['tmp_name'][$position];
        $imageSize = $images['size'][$position];
        $imageError = $images['error'][$position];
        $imageExt = strrchr($imageName, '.');
        if ($imageSize > $imageMaxSize) {
            echo ("The size of the file image $imageName is too big !<br>");
        } elseif (!in_array($imageExt, $allowedTypes)) {
            echo ("The type of the file $imageName is not allowed !<br>");
        } elseif ($imageError != 0) {
            echo ("An error was encourted with the upload of the file $imageName !<br>$imageError;<br>");
        } else {
            $imageUniqid = uniqid('', true) . $imageExt;
            $imageDestination = $imageDirectory . $imageUniqid;
            if(move_uploaded_file($imageTmp, $imageDestination)) {
/*//////////////////////////////// varray $upload not used here ///////////////////////////////*/
/*                $uploaded[$position] = $imageDestination;         */
                echo "Upload success for the image $imageName !<br>";
            } else {
                echo "The image $imageName failed to upload !";
            }
        }
    }
} else {
    echo "No file was found to upload !<br>";
}
echo "<p><a href='index.php'>Return to main page</a> </p>";