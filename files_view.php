<?php

include_once "db_login.php";

$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $conn -> prepare("SELECT * FROM filesdb WHERE id=?");
$stat->bind_param("i", $id);
$stat -> execute();
$rowurboat1 = $stat->get_result();
header('Content-Type:' . $rowurboat1['']);
echo $rowurboat1['data'];