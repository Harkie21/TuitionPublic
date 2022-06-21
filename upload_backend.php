<?php
include_once "db_login.php";
session_start();
date_default_timezone_set("Australia/Melbourne");
$not_valid3 = false;

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName1 = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileData = file_get_contents($_FILES['file']['tmp_name']);
    $fileName2 = ucfirst(trim(stripslashes(htmlspecialchars($fileName1))));
    $fileName3 = explode('.', $fileName2);
    $fileName = preg_replace("/\s+/", "", (array_values($fileName3)[0]));
    $fileTimeS = date("Y-m-d") . " " . date("H:i:s");
    $fileUniq = uniqid("", FALSE);

    if (isset($_SESSION['login_id'])) {
        $fileUploader = $_SESSION['login_id'];
    } else {
        $fileUploader = "Anonymous";
    }


    //print_r($fileUniq);

    $fileExt = explode('.', $fileName1);
    $fileActualExt = strtolower(end($fileExt));

    $allowedExt = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');

    if (empty($fileName1)) {
        $not_valid3 = "Please attach a file";
    } else {
        if (in_array($fileActualExt, $allowedExt)) {
            if ($fileError === 0) {
                if ($fileSize < 2000000) {
                    $fileNewName = $fileName . "_" . $fileUniq . "." . $fileActualExt;
                    $fileDestination = "Uploads/" . $fileNewName;
                    if (!$not_valid3) {
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $stmt = $conn->prepare('INSERT INTO fileslinkdb (timestamp, uniqid, file_name, file_fname, file_size, file_type, file_error, uploader) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
                        $stmt->bind_param("ssssisis", $fileTimeS, $fileUniq, $fileName, $fileNewName, $fileSize, $fileType, $fileError, $fileUploader);
                        $stmt->execute();

                        $_SESSION["not_valid3"] = $not_valid3;
                        header("Location: upload.php?uploadsuccess:)");
                    }
                } else {
                    $not_valid3 = "File size is too large!";
                }
            } else {
                $not_valid3 = "There was an error uploading your file!";
            }
        } else {
            $not_valid3 = "You can not upload files of this type!";
        }
    }
    $_SESSION["not_valid3"] = $not_valid3;
    header("Location: upload.php");
}