<?php

session_start();
include_once "../db_login.php";
include_once "../functions.php";

if (isset($_POST['login_id']) && isset($_POST['pass'])) {

    $login_id = cleanInput($_POST['login_id']);
    $pass = cleanInput($_POST['pass']);

    // Specific error messages that are sent back through GET
    if (empty($login_id)) {
        $_SESSION['templogin_id'] = "";
        header("Location: ../login.php?error=Username is Required");
    } elseif (empty($pass)) {
        header("Location: ../login.php?error=Password is Required");
        $_SESSION['templogin_id'] = $login_id;
    } else {
        // Hashing the pass
        $pass = md5($pass);

        $sql = "SELECT * FROM users WHERE login_id='$login_id' AND pass='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // the user name must be unique
            $row = mysqli_fetch_assoc($result);
            $dbrole = $row['role'];
            if ($row['pass'] === $pass) {
                unset($_SESSION['templogin_id']);
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['login_id'] = $row['login_id'];
                $_SESSION['role'] = $dbrole;
                // Taking user to the Home page if successful
                header("Location: ../home.php");
            } else {
                $_SESSION['templogin_id'] = $login_id;
                header(
                    "Location: ../login.php?error=Incorect Username or Password"
                );
            }
        } else {
            $_SESSION['templogin_id'] = $login_id;
            header(
                "Location: ../login.php?error=Incorect Username or Password"
            );
        }
    }
}
?>