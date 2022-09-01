<?php
define('IMG_PATH', 'images/');

$previsions = [
    '2018-02-11' => [
        'image_file' => 'degagement.gif',
        'image_desc' => 'icone degagement',
        'temperature' => '-17ºC',
    ],
    '2018-02-12' => [
        'image_file' => 'soleil_nuage.gif',
        'image_desc' => 'icone soleil et nuage',
        'temperature' => '-11ºC',
    ],
    '2018-02-13' => [
        'image_file' => 'neige.gif',
        'image_desc' => 'icone de neige',
        'temperature' => '-12ºC',
    ],
    '2018-02-14' => [
        'image_file' => 'soleil.gif',
        'image_desc' => 'icone soleil',
        'temperature' => '-15ºC',
    ],
    '2018-02-15' => [
        'image_file' => 'neige.gif',
        'image_desc' => 'icone de neige',
        'temperature' => '-11ºC',
    ],
    '2018-02-16' => [
        'image_file' => 'soleil.gif',
        'image_desc' => 'icone soleil',
        'temperature' => '-15ºC',
    ],
];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Tableau prévision</title>
    <style>
        body {
            width: 300px;
            margin: auto;
            border: 1px solid darkgrey;
            padding: 5px;
        }
    </style>

</head>

<body>
    <header>
        <h1>Prévision météo</h1>
    </header>
    <main>

        <table>


            <?php
            $content = "";
            foreach ($previsions as $date => $data) {
                $content .= '<tr>  <td>' .  $date . ' </td><td>  <img src="images/' . $data['image_file'] . '" alt="' . $data['image_desc'] . '">  </td><td>' . $data['temperature'] . '</td>  </tr>';
            }
            echo $content;
            ?>
        </table>
        <?php

        ?>
    </main>
</body>

</html>