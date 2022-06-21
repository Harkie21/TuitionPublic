<?php
session_start();
include 'db_login.php';
// Deletes the user/admin from the db
if (isset($_SESSION['login_id']) && isset($_SESSION['id'])) {
    $id  = $_GET['id'];
    $sql = "delete from users where id=$id";
    $conn->query($sql);
    $conn->close();
    header("location: members.php");
} else {
    header("location: logout.php");
}
?>
