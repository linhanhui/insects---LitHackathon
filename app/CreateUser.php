<?php 
include "common.php";

$username = $_GET['username'];
$password = $_GET['password'];
$company = $_GET['company'];
$department = $_GET['department'];
$team = $_GET['team'];
$id = $_GET['id'];


$dao = new UserDAO();

$user = new User($username,$password,$company,$department,$team,$id);

$result = $dao->create($user);

?>