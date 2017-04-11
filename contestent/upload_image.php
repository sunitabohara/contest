<?php
require_once 'contestent.class.php';
include '..\layout\header.php';

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = $_GET['id'];
    $obj = new Contestent();
    $result =$obj->getDetailById($id);

    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php
}?>
