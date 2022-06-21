<?php
include_once "header.php";
include_once "db_login.php";
include_once "functions.php";
$not_valid3 = false;
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="file"]').change(function (e) {

            var fileName = e.target.files[0].name;


            //alert('The file "' + fileName + '" has been selected.');

            let btn = document.querySelector("#button");

            btn.addEventListener("mouseover", function () {
                this.textContent = `Click to upload "` + fileName + `"`;
            })
            btn.addEventListener("mouseout", function () {
                this.textContent = "Submit";
            })
        });
    });
</script>

<link rel="stylesheet" href="style.css">
<div class="container d-flex justify-content-center align-items-center"
     style="min-height: 100vh">
    <form class="border shadow p-3 rounded" action="upload_backend.php" method="POST" enctype="multipart/form-data"
          style="width: 550px;">
        <h1 class="text-center p-3">UPLOAD FILES</h1>
        <!-- <input required type='text' name="title" maxlength="30" pattern="[a-zA-Z0-9äöüÄÖÜ()._- ]*$"
               title="Please only use letters, numbers and following special characters ' ) ( - . _  '"> -->
        <input type='file' name="file" style="width: 100%">
        <button class='button button2 button'
                type='submit'
                name="submit"
                id="button">Submit
        </button>
    </form>
</div>

<div class="container" style="margin-top: 5rem; margin-bottom: 5rem">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">File Name</th>
            <th scope="col">Time-stamp</th>
            <th scope="col">Uploader</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM fileslinkdb";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            //echo "<td><a href='uploads/" . $row['file_fname'] . "'>" . $row['file_name'] . "</a></td>";
            echo "<td><a href='upload_download.php?id=" . $row['id'] . "'>" . $row['file_name'] . "</a></td>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "<td>" . $row['uploader'] . "</td>";
            if (isset($_SESSION["role"])) {
                if ($_SESSION['role'] == 'Admin') {
                    echo '<td><a class="btn btn-danger" id="delete1" href="javascript:void(0)" onclick="deletemembers('
                        . $row['id'] . ')" role="button">Delete</a></td>';
                }
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
if (isset($_SESSION["not_valid3"])) {
    if ($not_valid3 != $_SESSION["not_valid3"]) {
        if ($_SESSION["not_valid3"] != "delete") {
            $not_valid3 = htmlspecialchars($_SESSION["not_valid3"]);
            echo <<<HTML
        <script>
            $(function () {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
                Toast.fire({
                  icon: 'error',
                  title: '$not_valid3',
                })        
            });
            

        </script>
HTML;
            unset($_SESSION["not_valid3"]);
        }
    } else {
        if ($not_valid3 == $_SESSION["not_valid3"]) {
            echo <<<HTML
        <script>
            $(function () {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
                Toast.fire({
                  icon: 'success',
                  title: 'File Uploaded Successfully'
                })        
            });
            

        </script>
HTML;
            unset($_SESSION["not_valid3"]);
        }
    }

}
?>

<script>

    // Function to delete members along with SweetAlert
    function deletemembers(id) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-info'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "LOL",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                //fetch("http://localhost/1/U2O1/members_delete.php?id=" + id)
                swalWithBootstrapButtons.fire({
                    title: 'Deleting!',
                    text: 'The file is being deleted.',
                    icon: 'success',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "upload_delete.php?id=" + id;
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'File not deleted',
                    'info'
                )
            }
        })
        // Weird loophole cus weird things
        $('#swal2-html-container').html("This file will be deleted <br> You won't be able to revert this!")
        return false;
    }
</script>
<?php
include_once "footer.php";
?>




