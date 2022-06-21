<?php

session_start();
include_once "db_login.php";
// Checking if the admin is logged in
if (isset($_SESSION['login_id']) && isset($_SESSION['id'])) {
    if (isset($_POST['pass']) && isset($_POST['newpass1'])
        && isset($_POST['newpass2'])
    ) {
        // Function to clean the inputs
        function test_input($data)
        {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $o_h_pass   = test_input($_POST['pass']);
        $pass       = test_input($_POST['newpass1']);
        $pass1      = test_input($_POST['newpass2']);
        $id         = $_POST['id'];
        $not_valid2 = false;
        $updatepass = false;
        $pattern    = '/[^a-zA-Z\d]/';

        // Specific errors based on what is not approved
        if (empty($o_h_pass)) {
            if ($_SESSION['role'] == 'Admin') {
                $not_valid2 = "Hash is Required";
            }
            else {
                $not_valid2 = "Original Password is Required";
            }
        }
        elseif (empty($pass)) {
            $not_valid2 = "New Password is Required";
        }
        elseif (empty($pass1)) {
            $not_valid2 = "New Password Confirmation is Required";
        }
        elseif (preg_match($pattern, "$pass")) {
            $not_valid2 = "Do not include special characters in New Password";
        }
        elseif (strlen($pass) < 4) {
            $not_valid2 = "Ensure New Password is greater than 3 characters";
        }
        elseif (strlen($pass) > 32) {
            $not_valid2 = "Ensure New Password is less than than 33 characters";
        }
        else {
            if ( ! ($pass === $pass1)) {
                $not_valid2 = "New Passwords do not match";
            }
            else {
                // Check the previous password/hash
                $sql = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $sql->bind_param("i", $id);
                $sql->execute();
                $row = $sql->get_result()->fetch_assoc();
                $sql->close();
                var_dump($row);

                if ($_SESSION['role'] != 'Admin') {
                    $pass3 = md5($o_h_pass);
                    if ($row['pass'] === $pass3) {
                        $updatepass = true;
                    }
                    else {
                        $not_valid2 = "Old password does not match";
                    }
                }
                else {
                    if ($row['pass'] === $o_h_pass) {
                        $updatepass = true;
                    }
                    else {
                        $not_valid2 = "Hash does not match";
                    }
                }
                // Updating the password in the db
                if (isset($updatepass) && ( ! $not_valid2)) {
                    $pass3 = md5($pass);
                    $sql   = $conn->prepare(
                        "UPDATE users SET pass=? WHERE id=?"
                    );
                    $sql->bind_param("si", $pass3, $id);
                    $sql->execute();
                }
                $conn->close();
            }
        }
    }
    echo $not_valid2;
    $_SESSION["not_valid2"] = $not_valid2;
    header("Location: members.php");
}
else {
    header("Location: logout.php");
}