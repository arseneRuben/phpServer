<?php
require_once "outils.php";
$message = Picture_Uploaded_Save_File('ma_photo', 'images');
if ($message !== 'OK') {
    die($message);
}
echo 'Picture saved OK';
