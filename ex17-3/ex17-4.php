<?php
require_once "db_pdo.php";
require_once "tools.php";

$DB = new db_pdo();
$DB->connect();
$regions = $DB->query("SELECT DISTINCT Region FROM profs ");
$regions = $regions->fetchAll(PDO::FETCH_OBJ);
$selectRegions = '<SELECT name="regions" class="rounded-input">';
$selectRegions .= '<option value=""> Choisir une region </option>';

foreach ($regions as  $r) {
    $selectRegions .= '<option value="' . $r->Region . '" >' . $r->Region . '</option>';
}
$selectRegions .= '</SELECT>';

if (isset($_POST['regions']) && strlen($_POST['regions']) > 0) {
    $query = 'SELECT * FROM profs WHERE Region=:region ORDER BY AnneeAffectation DESC';
    $params = [
        'region' => $_POST['regions']
    ];
    $results = $DB->querySelectParams($query, $params);
} else {
    $query = 'SELECT * FROM profs ORDER BY AnneeAffectation DESC';
    $results = $DB->querySelect($query);
}

//$profs = $results->fetchAll();
$table = tableToHtml($results);

//Affichage
echo '<form action="ex17-4.php" method="POST">';
echo $selectRegions;
echo '<input  type="submit" value="submit"></input>';
echo '</form>';
echo $table;
