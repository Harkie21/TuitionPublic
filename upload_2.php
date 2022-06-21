<?php
include_once "header.php";
include_once "db_login.php";
?>

    <div class="container" style="margin-top: 2rem;">
        <form action="upload_backend_2.php" method="POST" enctype="multipart/form-data">
            <input required type='text' name="title" maxlength="30" pattern="[a-zA-Z0-9äöüÄÖÜ()._- ]*$"
                   title="Please only use letters, numbers and following special characters ' ) ( - . _  '">
            <input type='file' name="file" required>
            <button type="submit" name="submit">UPLOAD</button>
        </form>
    </div>

    <div class="container" style="margin-top: 2rem;">
        <?php
        $stat = $conn->prepare("SELECT * FROM filesdb");
        $stat->execute();

        while ($row = $rowurboat->fetch_assoc()) {
            echo "<li><a target=_blank href='files_view.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></li>";
        }
        ?>
    </div>
<?php
include_once "footer.php";
?>