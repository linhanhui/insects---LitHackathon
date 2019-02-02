<?php 
include "common.php";

$content = $_GET['content'];
$company = $_GET['company'];
$department = $_GET['department'];
$team = $_GET['team'];
$id = $_GET['id'];
$username = $_GET['username'];
$cases = $_GET['cases'];


$dao = new NotesDAO();

$notes = new Notes($content,$company,$department,$team,$id,$username,$cases);

$result = $dao->create($notes);
// print($result);
?>