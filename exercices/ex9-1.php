<?php
function showTitle($title)
{
    echo "<h2>&#9830; $title</h2>";
    echo '<hr/>';
}

// reference https://www.php.net/manual/fr/function.date.php
// formatage de la date https://www.php.net/manual/fr/datetime.format.php

showTitle('Exercise 00 timestamp actuel, nombre de secondes depuis 1er janvier 1970 (votre réponse sera différente de celle ci-dessous)');
// votre code ici
print_r(time());
showTitle('Exercise 01 Créer le timestamp pour 20h:25min:10s le 10 janvier 2019 avec 2 méthodes: mktime() et strtotime()');
// votre code ici
echo  mktime(20, 25, 10, 1, 10, 2019);
echo '<br/>';
echo  strtotime('10 January 2019 20 hours 25 minutes 10 seconds');
// Les exercises suivants doivent afficher les résultats pour le 10 janvier 2019
// à 20h:25min:10s , pas pour la date courante!
echo '<br/>';

showTitle('Exercice 1 Date et heure au complet en format DATE_RFC2822');
// votre code ici
echo date(DATE_RFC2822, time());
echo '<br/>';

showTitle('Exercice 2 Le jour du mois seulement');

// votre code ici
echo date('d',  time());
echo '<br/>';
showTitle('Exercice 3 Le mois en chiffre et en texte complet');
// votre code ici
echo date('m',  time());
echo '<br/>';
echo date('M',  time());
echo '<br/>';
showTitle('Exercice 4 Année seulement');
// votre code ici
echo date('Y',  time());
echo '<br/>';
showTitle('Exercice 5 Date en format 10,January,2019');
// votre code ici
echo date("d,F,Y");
echo '<br/>';
showTitle('Exercice 6 Ajoute 1 mois à la date avec strtotime(), et affichage complet');
// votre code ici
$date = "2021-11-01";
echo  $date;
echo '<br/>';
$newDate = date('Y-m-d', strtotime($date . ' + 1 months'));
echo   $newDate;
showTitle('Exercice 7 Nombre de jours écoulés entre le 10 janvier 2019 et le 31 décembre 1973');
// votre code ici
$firstDate =  "2019-10-01";
$secondDate = "1973-12-31";
$firstDateToTime = strtotime("2019-10-01");
$secondDateToTime = strtotime("1973-12-31");
$difference =  ceil(($firstDateToTime - $secondDateToTime) / (60 * 60 * 24));  // round, ceil, flor
echo "il y a $difference jours entre  $firstDate et $secondDate";
showTitle('Exercice 8 Date en format Thursday, 10 January 2019');
// votre code ici
echo date('l, jS  F Y');
