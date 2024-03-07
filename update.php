<?php 
include_once "assets/php/header.php";
require_once "assets/php/classes/UsersDto.php";
require_once "assets/php/db.php";
$config = require_once "assets/php/config.php";
use db\DB_PDO as Database;
use dto\UserDTO as Dto;

$pdoConn = Database::getInstance($config);
$conn = $pdoConn->getConnection();
$usersCard = new Dto($conn);
$res = $usersCard->getUsersID($_GET['idUtente']);
var_dump($res)
?>