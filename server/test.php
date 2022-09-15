<?php
require_once "db_pdo.php";
$DB = new db_pdo();
$DB->connect();
/*
$results = $DB->query("Select * from users;");
echo ($results->rowCount()); //nombre d'usager

$users = $results->fetchAll();
var_dump($users);

$users = $DB->querySelect("Select * from users;");
var_dump($users);

$users = $DB->table("users");
var_dump($users);
*/