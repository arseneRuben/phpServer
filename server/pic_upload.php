<?php
require_once "outils.php";
$message = Picture_Uploaded_Save_File('ma_photo', 'images');
if ($message !== 'OK') {
    die($message);
}
echo 'Picture saved OK';
// // IMPORTANT ONCE UPLOADED WITH CODE ABOVE THE IMAGE IS NO
// // LONGER AVAILABLE - TO EXECUTE CODE BELOW COMMENT OUT CODE ABOVE !

// // Example #2 saving image in a database table -------------------------------
require_once 'db_pdo.php';
$file_input = 'the_file'; // field name on form
$message = Picture_Uploaded_Is_Valid($file_input); // voir fonction
if ($message === 'OK') {
    $mime_type = Picture_Uploaded_Mime_Type($file_input); // voir function
    if ($mime_type != 'ERROR') {
        $image = file_get_contents($_FILES[$file_input]['tmp_name']);

        // converts image in base64
        // https://www.php.net/manual/en/function.base64-encode.php
        $image_base64 = base64_encode($image);

        //display image in binary format
        echo '<h2>image received</h2>';
        echo '<img src="data:' . $mime_type . ';base64,' . $image_base64 . '" alt="an image" />';

        // insert in database classicmodels, see db_pdo.php
        // table productcategories, image field mediumblob
        // BLOB = binary long object to save images in DB mysql
        $DB = new db_pdo();
        $DB->connect();
        $DB->query('UPDATE productcategories SET image="' . $image_base64 . '" WHERE name="planes"');

        //extract from DB and display to test
        $records = $DB->querySelect('SELECT * from productcategories WHERE name="planes"');
        $image_base64 = $records[0]['image'];
        echo '<h2>image in database</h2>';
        echo '<img src="data:image;base64,' . $image_base64 . '" alt="an image" />';
    } else {
        echo 'Error file type not supported';
    }
} else {
    echo $message;
}
