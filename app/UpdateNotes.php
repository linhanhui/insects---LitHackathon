<?php
include "common.php";

$company = $_GET['company'];
$department = $_GET['department'];
$team = $_GET['team'];
$cases = $_GET['cases'];
$content = $_GET['content'];



$dao = new NotesDAO();

$notes = $dao->update($content,$department,$team,$cases,$company);


// $info = ["content" => $notes->content, "company" => $notes->company,"department" => $notes->department,"team" => $notes->team,"id" => $notes->id,"username" => $notes->username,"cases" => $notes->cases];

// $infoJson = json_encode($info);

// echo $infoJson;

?>