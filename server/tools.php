<?php
function viewCount($filename)
{

    $visit = null;
    if (file_exists($filename)) {
        $visit = file_get_contents($filename);
        $visit = intval($visit);
    } else {
        $visit = 0;
    }
    $visit++;
    file_put_contents($filename, $visit);
    return $visit;
}


function redirect($url)
{
    header("Location: " . $url);
}


function logVisitor($log_file)
{
    file_put_contents("log" . DIRECTORY_SEPARATOR . $log_file, date(DATE_RFC2822) . " " . $_SERVER['REMOTE_ADDR'] . "\n", FILE_APPEND);
}

function crash($http_code, $msg)
{
    header('HTTP/1.0  ' . $http_code . ' ' . $msg);
    die($msg);
}

function download($filename)
{
    header("Content-Type: application/pdf");
    header('Content-Disposition: attachement; filename ="' . $filename . '"');
    readfile($filename);
}

/**
 * $name : The name of the input
 * $maxLength : the max lenght of the input if it exists
 * $minLength : the max lenght of the input if it exists
 * $required : specifies if the input is requered
 */
//  ecrire une fonction de verification
function checkInput($name,  $maxLength = 0, $minLength = 1000, $required, $errors = "")
{
    if (!isset($_REQUEST[$name])) {
        $errors .= $name . " is required <br/>";
        crash(400,  $errors);
    } else {
        $input = trim($_REQUEST[$name]);
        if ($required && ($input === '')) {
            $errors .= $name . " is required<br/>";
            crash(400,  $errors);
        }
        if (($maxLength != 0) && (strlen($input) > $maxLength)) {
            $errors  .= $name . " must have at must " . $maxLength . "characters<br/>";
            crash(400,   $errors);
        }
        if (($minLength != 1000) && (strlen($input) < $minLength)) {
            $errors  .= $name . " must have at most " . $minLength . "characters<br/>";
            crash(400,   $errors);
        }

        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if ($name === "email" && !preg_match($pattern, $input)) {
            $errors .= $input . "is an  invalid Email\n";
            crash(400,    $errors);
        }
    }

    return htmlspecialchars($input);
}

function  tableToHtml($table)
{
    if ($table === []) {
        $html = "tableau vide";
    } else {
        $html = '<table  class="table"><thead>';
        foreach (array_keys($table[0]) as $key) {
            $html .= '<th scope="col">' . $key . '</th>';
        }
        $html .= '<th scope="col">Actions</th>';
        $html .=  "</thead><tbody>";
        foreach ($table as $produit) {
            $html .= "<tr>";

            foreach (array_keys($table[0]) as $key) {
                $html .= "<td>" . $produit[$key] . "</td>";
            }
            $html .= '<td>
                            <a   href="index.php?op=140&id=' . ($produit['id']) . '" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a >
                            <a   href="index.php?op=130&id=' . ($produit['id']) .  '" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a >
                            <a   href="index.php?op=190&id=' . ($produit['id']) .  '" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a >
                     </td>';
            $html .= "</tr>";
        }

        $html .=  "</tbody></table>";
    }
    return $html;
}

/**
 * Return the image MIME type (content-type).
 *
 * Attention: Use function Photo_Uploaded_Is_Valid() before !
 * We take for granted the photo validity was verified before.
 *
 * @param string $file_input the file name input on the form
 *
 * @return string the MIME type for example 'image/jpeg' or 'ERROR'
 */
function Picture_Uploaded_Mime_Type($file_input)
{
    $filePathArray = pathinfo($_FILES[$file_input]['name']);
    $fileExtension = $filePathArray['extension'];
    switch ($fileExtension) {
        case 'jpg':
        case 'JPG':
            return 'image/jpeg';

        case 'gif':
        case 'GIF':
            return 'image/gif';

        case 'png':
        case 'PNG':
            return 'image/png';
    }

    return 'ERROR';
}

/**
 * Converts image in base64 to put in a database.
 *
 * @param string $file_input the file name input on the form
 */
function Picture_Uploaded_base64($file_input)
{
    $message = Picture_Uploaded_Is_Valid($file_input); // see function
    if ($message !== 'OK') {
        return $message;
    }
    $image = file_get_contents($_FILES[$file_input]['tmp_name']);

    // convert image in base64
    // https://www.php.net/manual/en/function.base64-encode.php
    $image_base64 = base64_encode($image);

    return $image_base64;
}

/**
 * Check uploaded file contains a valid image
 * extension must be: .jpg , .JPG , .gif ou .png.
 *
 * @param string $file_input the file input name on the HTML form
 * @param int    $Max_Size   maximum file size, default 500kb
 *
 * @return 'OK' or error message
 */
function Picture_Uploaded_Is_Valid($file_input, $Max_Size = 500000)
{
    //Form must have <form enctype="multipart/form-data" ..
    //otherwise $_FILE is undefined
    // $file_input is the file input name on the HTML form
    if (!isset($_FILES[$file_input])) {
        return 'No image uploaded';
    }

    //check for upload error
    if ($_FILES[$file_input]['error'] != UPLOAD_ERR_OK) {
        return 'Error picture upload: code=' . $_FILES[$file_input]['error'];
    }

    // Check image size
    if ($_FILES[$file_input]['size'] > $Max_Size) {
        return 'Image too big, max file size is ' . $Max_Size . ' Kb';
    }

    // Check that file actually contains an image
    $check = getimagesize($_FILES[$file_input]['tmp_name']);
    if ($check === false) {
        return 'This file is not an image';
    }

    // Check extension is jpg,JPG,gif,png
    $filePathArray = pathinfo($_FILES[$file_input]['name']);
    $fileExtension = $filePathArray['extension'];
    if ($fileExtension != 'jpg' && $fileExtension != 'JPG' && $fileExtension != 'gif' && $fileExtension != 'png') {
        return 'Invalid image file type, valid extensions are: .jpg .JPG .gif .png';
    }

    return 'OK';
}
/**
 *  Function to save uploaded image in a target directory
 *  (and display image for testing).
 *
 *  @param string $file_input the file input name on the HTML form
 *  @param string $target_dir the directory where to save picture
 *
 *  @return string OK or error message
 */
function Picture_Uploaded_Save_File($file_input, $target_dir)
{
    $message = Picture_Uploaded_Is_Valid($file_input); // voir fonction
    if ($message === 'OK') {
        // Check that no file with the same name already exists
        // in the target directory
        $target_file = $target_dir . basename($_FILES[$file_input]['name']);
        if (file_exists($target_file)) {
            return 'This file already exists';
        }

        // Create the file with move_uploaded_file()
        if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $target_file)) {
            // ALL OK
            //display image for testing, comment next line when done
            // echo '<img src="' . $target_file . '">';


            return 'OK';
        } else {
            return 'Error in move_upload_file';
        }
    } else {
        // upload error, invalid image or file too big
        return $message;
    }
}
