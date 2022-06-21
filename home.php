<style>

    /*body {*/
    /*    background-image: url("Files/Pictures/back1.jpg");*/
    /*    background-color: #000000;*/
    /*    background-repeat: no-repeat;*/
    /*    background-attachment: scroll;*/
    /*    background-size: cover;*/
    /*}*/

    /*.p-3 {*/
    /*    color: white;*/
    /*    text-shadow: white;*/
    /*}*/

</style>


<?php

include "db_login.php";
include_once "header.php";
// Checking if user is logged in
if (isset($_SESSION['login_id']) && isset($_SESSION['id'])) { ?>
    <div class="container d-flex justify-content-center align-items-center"
         style="min-height: 95vh">
        <div class="p-3">
            <!-- Displays a welcome message along with the name -->
            <h1 class="display-4 fs-1">Welcome <?= $_SESSION['name'] ?> 🃎</h1>
        </div>
    </div>
    <div class="card" style="width: 50%; margin: auto; padding-bottom: 10px">
        <div class="card-body text-center">
            <h5 class="card-title">
                <!-- Little card for quick logout -->
                <?= $_SESSION[('name')]
                . " <i><sup style='font-size: 60%; text-transform: lowercase'>"
                . $_SESSION[('role')] . "</sup></i>" ?>
            </h5>
            <a href="logout.php" class="btn btn-dark">Logout</a>
        </div>
    </div><br><br><?php
} else {
    header("Location: login.php");
} ?>
<?php include_once 'footer.php'; ?>
