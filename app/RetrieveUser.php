<?php
include "common.php";

$id = $_GET['id'];

$dao = new UserDAO();

$user = $dao->retrieve($id);

$info = ["username" => $user->username, "password" => $user->password,"company" => $user->company,"department" => $user->department,"team" => $user->team,"id" => $user->id];

$infoJson = json_encode($info);

echo $infoJson;

?>