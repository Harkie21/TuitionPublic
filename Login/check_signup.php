<?php

session_start();
include_once "../db_login.php";
include_once "../functions.php";

if (isset($_POST['login_id']) && isset($_POST['name']) && isset($_POST['pass1'])
    && isset($_POST['pass'])
) {

    $login_id = cleanInput($_POST['login_id']);
    $pass = cleanInput($_POST['pass']);
    $role = cleanInput("User");
    $name = ucfirst(cleanInput($_POST['name']));
    $email = cleanInput($_POST['email']);
    $phone = cleanInput($_POST['phone1']);
    $pass1 = cleanInput($_POST['pass1']);
    $not_valid = false;

    // Specific error messages per fault stored in a var
    if (empty($name)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Name is Required";
    } elseif (empty($login_id)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Username is Required";
    } elseif (empty($email)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Email is Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Enter a valid E-mail";
    } elseif (empty($phone)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Phone is Required";
    } elseif ($role !== "User") {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Funny Guy <3";
    } elseif (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Enter a valid Phone #";
    } elseif (empty($pass)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Password is Required";
    } elseif
    (empty($pass1)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Password Confirmation is Required";
    } elseif
    (!($pass === $pass1)) {
        $_SESSION['tempname'] = $name;
        $_SESSION['tempreglogin'] = $login_id;
        $_SESSION['tempmail'] = $email;
        $_SESSION['tempphone'] = $phone;
        $not_valid = "Passwords do not match";
    } else {
        // Hashing the pass
        $pass = md5($pass);

        $sql = "SELECT * FROM users WHERE login_id='$login_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // the user name must be unique
            $row = mysqli_fetch_assoc($result);
            if ($row['login_id'] === $login_id) {
                $not_valid = "Username is already in use";
                $_SESSION['tempname'] = $name;
                $_SESSION['tempreglogin'] = $login_id;
                $_SESSION['tempmail'] = $email;
                $_SESSION['tempphone'] = $phone;
            }
        }
    }

// If no errors have occurred, insert the values into db
    if (!$not_valid) {
        unset($_SESSION['tempname']);
        unset($_SESSION['tempreglogin']);
        unset($_SESSION['tempmail']);
        unset($_SESSION['tempphone']);
        $sql = $conn->prepare(
            "INSERT INTO users (role, login_id, pass, name, phone, email) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $sql->bind_param("ssssss", $role, $login_id, $pass, $name, $phone, $email);
        $sql->execute();
    }
    $conn->close();

}
// Setting the var in a session var so it can be checked in other pages
$_SESSION["not_valid"] = $not_valid;
header("Location: ../signup.php");
?>