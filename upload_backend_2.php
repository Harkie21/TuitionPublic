<?php

include_once "db_login.php";

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileData = file_get_contents($_FILES['file']['tmp_name']);
    $fileTitle1 = ucfirst(trim(stripslashes(htmlspecialchars($_POST['title']))));
    $fileTitle = preg_replace("/\s+/", "", $fileTitle1);


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowedExt)) {
        if ($fileError === 0) {
            if ($fileSize < 2000000) {
                $fileNewName = uniqid($fileTitle . "_", FALSE) . "." . $fileActualExt;
                $stmt = $conn -> prepare('INSERT INTO filesdb (title, mime, data) VALUES(?, ?, ?)');
                $stmt->bind_param("sss", $fileNewName, $fileType, $fileData);
                $stmt -> execute();
                header("Location: upload_2.php?uploadsuccess:)");
            } else {
                echo "File size is too large!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You can not upload files of this type!";
    }

}