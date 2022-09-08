<?php

$nom = "Thomas Sankara";

const COUNTRY = "Burkina Faso";

echo '<b>' . $nom . "</b> fut president du " . COUNTRY;
$var = 'Jean';
$Var = 'Marie';
echo  "<b>  $var </b> et $Var  habitent" . COUNTRY;
$leaders = ['id' => 1, 'nom' => $nom, 'mendat' => 9];
var_dump($leaders);
echo $leaders;
