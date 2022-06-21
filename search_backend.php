<?php

include_once "db_login.php";
if (isset($_POST['search'])) {
    $search = $_POST["search"];
    $search1 = "%$search%";

    if ((strlen($search)) > 2) {
        $sql
            = "SELECT * FROM users WHERE name LIKE ? || role LIKE ? || phone LIKE ? || email LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $search1, $search1, $search1, $search1);
        $stmt->execute();
        $rowurboat = $stmt->get_result();

        while ($row = $rowurboat->fetch_assoc()) {
            $role = $row['role'];
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];

            echo "<div class='contact'>$name<br><b>$role</b><br><u>$phone</u><br><a href='mailto:$email'><b><i>$email</i></b></a></div>";
        }
    }
}

?>
