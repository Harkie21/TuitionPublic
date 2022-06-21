<?php
include_once "db_login.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM fileslinkdb WHERE id = $id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    $filepath = 'Uploads/' . $data['file_fname'];
    $array = explode('.', $data['file_fname']);
    $array1 = end($array);
    $filedownloadname = $data['file_name'] . "." . $array1;


    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename= ' . $filedownloadname);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        exit;
    }


}
//' . basename($filepath) . '"