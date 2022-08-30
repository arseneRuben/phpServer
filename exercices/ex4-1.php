<?php
function showTitle($title)
{
    echo "<h2>&#9830; $title</h2>";
    echo '<hr/>';
}
function str_word_count_utf8($str)
{
    return count(preg_split('~[^\p{L}\p{N}\']+~u', $str));
}

$phrase = 'Une phrase qui doit être affichée en mettant un mot par ligne';

showTitle('Exercice 1: nombre de caractères avec mb_strlen()');
echo ' ', mb_strlen($phrase);
showTitle('Exercice 2: nombre de mots avec str_word_count_utf8()');
echo ' ', str_word_count_utf8($phrase);

showTitle('Exercice 3: en majuscule avec strtoupper()');
echo ' ', strtoupper($phrase);

showTitle('Exercice 4: première lettre de chaque mot en majuscule avec ucwords()');
echo ' ', ucwords($phrase);
showTitle('Exercice 7: nombre de caractères sans les espaces avec substr_count()');
echo ' ',  mb_strlen($phrase) - substr_count($phrase, ' ');

showTitle('Exercice 8: changer a pour b, c pour d, e pour f avec strtr()');
$trans = array("a" => "b", "c" => "d", "e" => "f");
echo ' ', strtr($phrase, $trans);
