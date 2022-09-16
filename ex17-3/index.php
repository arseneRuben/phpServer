<?php
require_once "db_pdo.php";
require_once "tools.php";

$DB = new db_pdo();
$DB->connect();

$results = $DB->query("SELECT * FROM profs ORDER BY AnneeAffectation DESC");
$users = $results->fetchAll();
$table = tableToHtml($users);
echo $table;
