<?php
include 'header.php';
include 'db_login.php';
?>
    <style>

        .table th {
            border-bottom: transparent;
            border: transparent;
        }

        /* Styling for Sweetalert */
        .swal-hw {
            height: 96vh;
        }

        .swal2-confirm {
            margin: 10px !important;
        }

        .swal2-cancel {
            margin: 10px !important;
        }
    </style>
    <!-- SweetAlert embed -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// Checks the variable that is changed in MEMBERS_UPDATE.PHP and outputs a Sweetalert
$not_valid1 = false;
$not_valid2 = false;

if (isset($_SESSION["not_valid1"])) {
    if ($not_valid1 != $_SESSION["not_valid1"]) {
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
                  title: 'Updated Successfully'
                })        
            });
            

        </script>
HTML;
    }
    unset($_SESSION["not_valid1"]);
}

// Checks the variable that is changed in MEMBERS_PASSCHANGE.PHP and outputs a Sweetalert
if (isset($_SESSION["not_valid2"])) {
    if ($not_valid2 != $_SESSION["not_valid2"]) {
        $not_valid3 = htmlspecialchars($_SESSION["not_valid2"]);
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
        unset($_SESSION["not_valid2"]);
    } else {
        if ($not_valid2 == $_SESSION["not_valid2"]) {
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
                  title: 'Updated Password Successfully'
                })        
            });
            

        </script>
HTML;
            unset($_SESSION["not_valid2"]);
        }
    }
}
?>


    <div class="container d-flex justify-content-center align-items-center"
         style="min-height: 20vh">
        <div class="p-3">
            <!-- Changes title depending or role -->
            <h1 class="display-4 fs-1">Manage <?= ($_SESSION['role'] == 'Admin')
                    ? "Members" : "Account" ?></h1>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Username</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                // Checking as to only display account details depending on role
                if ($_SESSION['role'] == 'User'
                    && $row['id'] != $_SESSION['id']
                ) {
                    continue;
                }
                echo "<tr>";
                if (isset($_GET['id']) && $row['id'] == $_GET['id']) {
                    // When you click update it sends a GET['id'], this reads that request and updates the page
                    echo '<form class="form-inline m-2" action="members_update.php" method="POST" autocomplete="off">';
                    echo '<td><input type="text" required class="form-control" pattern="^[A-Za-z]+$" title="Please only use letters" name="name" value="'
                        . $row['name'] . '"></td>';
                    if ($_SESSION['role'] == 'Admin') {
                        echo '<td><select class="form-control"  name="role" aria-label="Default select example">';
                        // Keeps the role of selected user/admin selected when updating
                        if ($row['role'] == 'Admin') {
                            echo "<option value='Admin'>Admin</option>
                                <option value='User'>User</option>";
                        } else {
                            echo "<option selected value='User'>User</option>
                        <option value='Admin'>Admin</option>";
                        }
                        echo '</select></td>';
                    } else {
                        // No option to change role for users
                        echo "<td>User</td>";
                    }
                    echo '<td><input type="text" required class="form-control" name="login_id" value="'
                        . $row['login_id'] . '"></td>';
                    echo '<td><button type="submit" class="btn btn-outline-info">Save</button></td>';
                    echo '<td><a href="members.php" class="btn btn-secondary">Cancel</a></td>';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '</form>';
                } else {
                    // Name, Role, and LoginID of all admins/users
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['login_id'] . "</td>";
                    echo '<td><a class="btn btn-info" href="members.php?id='
                        . $row['id'] . '" role="button">Update</a></td>';
                    echo '<td><a class="btn btn-outline-info" href="javascript:void(0)" role="button" onclick="passchange('
                        . $row['id'] . ')">Change Password</a></td>';
                }
                // Only shows option for delete if admin is logged in
                if ($_SESSION['role'] == 'Admin') {
                    echo '<td><a class="btn btn-danger" id="delete1" href="javascript:void(0)" onclick="deletemembers('
                        . $row['id'] . ')" role="button">Delete</a></td>';
                }
                echo "</tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div><br><br>
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
                        title: 'Deleted!',
                        text: 'The account has been deleted.',
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "members_delete.php?id=" + id;
                        }
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Account not deleted',
                        'info'
                    )
                }
            })
            // Weird loophole cus weird things
            $('#swal2-html-container').html("This account will be deleted <br> You won't be able to revert this!")
            return false;
        }

        // Changing password using SweetAlert
        async function passchange(id) {

            const {value: formValues} = await Swal.fire({
                title: 'Password Change',
                icon: 'info',
                width: 600,
                showCancelButton: true,
                reverseButtons: true,
                customClass: 'swal-hw',
                html: `
                    <form id="passchange" action="members_passchange.php" method="POST"><div class="mb-3">
                    <label for="passchange" class="form-label">Enter <?= ($_SESSION['role']
                    == 'Admin') ? 'hashed' : 'old'?> password:</label><br>
                    <input id="swal-input1" name="pass" class="swal2-input"></div>
                    <div class="mb-3"> 
                    <label for="passchange" class="form-label">Enter the new password:</label><br> 
                    <input id="swal-input2" name="newpass1" class="swal2-input"></div>
                    <div class="mb-3">
                    <label for="passchange" class="form-label">Confirm the new password:</label> 
                    <input id="swal-input3" name="newpass2" class="swal2-input"></div>
                    <input id="swal-input4" hidden name="id" class="swal2-input" value="${id}"></div>
                    </form>
                    `,
                focusConfirm: false,
                preConfirm: () => {
                    document.getElementById("passchange").submit();
                }
            })
            /*
            document.getElementById("swal-input2").setAttribute("pattern", "/^(?=.*[a-z])(?=.*[A-Z]).{4,32}$/");
            document.getElementsByClassName("swal2-confirm")[0].setAttribute("type", "submit");
            document.getElementsByClassName("swal2-confirm")[0].setAttribute("form", "passchange");
            */
        }

    </script>
<?php
include_once 'footer.php'; ?>