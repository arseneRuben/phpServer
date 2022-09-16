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
function checkInput($name,  $maxLength = 0, $required, $errors = "")
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
        $html = "<table border='1'><thead>";
        foreach (array_keys($table[0]) as $key) {
            $html .= "<th>" . $key . "</th>";
        }
        $html .=  "</thead><tbody>";
        foreach ($table as $produit) {
            $html .= "<tr>";
            foreach (array_keys($table[0]) as $key) {
                $html .= "<td>" . $produit[$key] . "</td>";
            }
            $html .= "</tr>";
        }

        $html .=  "</tbody></table>";
    }
    return $html;
}
