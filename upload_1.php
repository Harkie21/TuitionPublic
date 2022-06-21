<?php
include_once "header.php";
include_once "db_login.php";
?>

    <div class="container" style="margin-top: 2rem;">
        <form action="upload_backend_1.php" method="POST" enctype="multipart/form-data">
            <input type='text' name="title" maxlength="20" pattern="[a-zA-Z0-9äöüÄÖÜ()._-]*$"
                   title="Please only use letters, numbers and following special characters ' ) ( - . _  '">
            <input type='file' name="file" required>
            <button type="submit" name="submit">UPLOAD</button>
        </form>
    </div>
<?php
include_once "footer.php";
?>