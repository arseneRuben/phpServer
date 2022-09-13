<?php
require_once "db_pdo.php";
$DB = new db_pdo();
$DB->connect();
$results = $DB->query("Select * from users;");
echo ($results->rowCount()); //nombre d'usager

$users = $results->fetchAll();
var_dump($users);
