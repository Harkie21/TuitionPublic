<?php

exit();
?>


<!--
FROM CHECK_LOGIN.PHP
    <div class="mb-1">
                    <label class="form-label">Select User Type:</label>
                </div>
                <select class="form-select form-select-sm"
                        style="width: 100%"
                        name="role"
                        aria-label="Default select example">
                    <option selected value="User">User</option>
                    <option value="Admin">Admin</option>
                </select><br><br>

FROM HOMEADMIN.PHP
    == Placed for the "width" styling possibly for later use ==
    <div class="card"  style="width: 18rem; margin: auto; padding-bottom: 10px">
        <div class="card-body text-center">
            <h5 class="card-title">
                <?= $_SESSION['name'] ?>
            </h5>
            <a href="logout.php" class="btn btn-dark">Logout</a>
        </div>
    </div><br><br>

FROM MEMBERS.PHP - ORIGINAL CODE

    REMOVE "[]" FROM "<[]?"

    <[]?php

    include "db_login.php";
    include_once "header.php";


        $sql = "SELECT * FROM users ORDER BY id ASC";
        $res = mysqli_query($conn, $sql);?>
        <div class="container d-flex justify-content-center align-items-center"
             style="min-height: 100vh">
    <[]?php if (mysqli_num_rows($res) > 0) { ?>
        <br>
        <h2 class="display-5">Members</h2>
        <table class="table"
               style="width: 32rem;">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
            <[]?php
            $i = 1;
            while ($rows = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <th scope="row"><[]?= $i ?></th>
                    <td><[]?= $rows['name'] ?></td>
                    <td><[]?= $rows['login_id'] ?></td>
                    <td><[]?= $rows['role'] ?></td>
                </tr>
                <[]?php
                $i++;
            } ?>
            </tbody>
        </table>
        <[]?php
    }

FROM MEMBERS.PHP
== BACKUP ==
if ($_SESSION['role'] == 'Admin') echo '<td><a class="btn btn-danger" id="delete1" href="members_delete.php?id='
                .$row['id'].'" role="button">Delete</a></td>';
            echo "</tr>";

FROM MEMBERS.PHP
== DELETE MESSAGES ==

a.onclick = function() {

              const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "This account will be deleted /n You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "http://localhost/1/U2O1/home.php";
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'The account has been deleted.',
                  'success'
                )
              } else if (
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Account not deleted',
                  'error'
                )
              }
            })
            return false;
         }


=======================

FROM MEMBERS.PHP

== JS form password form validation ==

function validateForm() {
        var x = document.forms["passchange"]["newpass1"].value;
        var y = /^(?=.*[a-z])(?=.*[A-Z]).{4,32}$/;
        document.write("x");
            if (y.test(x.value) == false) {
                event.preventDefault();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    Toast.fire({
                        'Password is not valid',
                        'Please include atleast one uppercase and lowercase character. Ensure the password is between 4-32 characters',
                        'error'
                    });
                x.focus();
                return false;
            }
    }


===============================

FROM UPLOAD.PHP

CHECK IF A FILE HAS BEEN SELECTED

if ($("#uploadFile").val()) {

        } else {
            $("#buttonspan").html(" Exercises Solution");
            print()
        }

-->