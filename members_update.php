<?php
session_start();
include 'db_login.php';
include_once 'functions.php';

// Checking if user/admin is logged in
if (isset($_SESSION['login_id']) && isset($_SESSION['id'])) {
    $role = cleanInput(
        ($_SESSION['role'] == 'Admin') ? $_POST['role'] : 'user'
    );
    $id = cleanInput($_POST['id']);
    $name = ucfirst(cleanInput($_POST['name']));
    $login_id = cleanInput($_POST['login_id']);
    $not_valid1 = false;

    // Updating the necessary info
    $sql = $conn->prepare(
        "UPDATE users SET role = ?, login_id = ?, name = ? WHERE id = ?"
    );
    $sql->bind_param("sssi", $role, $login_id, $name, $id);
    $sql->execute();
    $conn->close();
    $not_valid1 = true;
    $_SESSION["not_valid1"] = $not_valid1;
    header("location: members.php");
} else {
    header("Location: logout.php");
}
