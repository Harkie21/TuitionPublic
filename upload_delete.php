<?php
session_start();
include_once 'db_login.php';
$not_valid3 = false;
$id = $_GET['id'];

if (isset($_GET['id']) && $_SESSION['role'] == 'Admin') {
    $query = "SELECT * FROM fileslinkdb WHERE id = $id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    $filepath = 'Uploads/' . $data['file_fname'];

    if (!unlink($filepath)) {
        $not_valid3 = "Could not delete file";
    } else {
        $sql = "DELETE FROM fileslinkdb WHERE id = $id";
        $conn->query($sql);
        $conn->close();
        $not_valid3 = "delete";
        header("location: upload.php?deletesuccess");
    }
} else {
    $not_valid3 = "User does not have adequate authorization";
}
$_SESSION["not_valid3"] = $not_valid3;
header("location: upload.php");
?>