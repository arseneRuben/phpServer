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
