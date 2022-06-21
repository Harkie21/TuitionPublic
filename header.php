<style>

    * {
        font-family: 'Inconsolata', monospace;
        font-size: 20px;
    }

    /* Styling for buttons and dropdowns */
    .radio-toolbar {
        margin: 10px;
    }

    .radio-toolbar input[type="radio"] {
        opacity: 0;
        position: fixed;
        width: 0;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #fff;
        padding: 10px 20px;
        font-family: sans-serif, Arial;
        font-size: 16px;
        border: 2px solid #008CBA;
        border-radius: 4px;
        color: #008CBA;
    }

    .radio-toolbar label:hover {
        background-color: #adebff;
    }

    .radio-toolbar input[type="radio"]:focus + label {
        border: 2px dashed #444;
        background-color: #fff;
    }

    .radio-toolbar input[type="radio"]:checked + label {
        background-color: #008CBA;
        color: #fff;
        border-color: #006a8c;
    }

    .navbar-nav a.dropdown-item {
        padding: 5px 10px;
    }

    .navbar-nav li a {
        padding: 0 0 0 0;
    }

    .dropdown-menu-center {
        left: 50% !important;
        right: auto !important;
        text-align: center !important;
        transform: translate(-50%, 0) !important;
    }

    .myButton {
        box-shadow: 3px 4px 0px 0px #8a2a21;
        background: linear-gradient to bottom, #c62d1f 5%, #f24437 100%;
        background-color: #c62d1f;
        border-radius: 18px;
        border: 1px solid #d02718;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 17px;
        padding: 7px 25px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #810e05;
    }

    .myButton:hover {
        background: linear-gradient to bottom, #f24437 5%, #c62d1f 100%;
        background-color: #f24437;
    }

    .myButton:active {
        position: relative;
        top: 1px;
    }

    .myButton1 {
        box-shadow: 3px 4px 0px 0px #276873;
        background: linear-gradient to bottom, #599bb3 5%, #408c99 100%;
        background-color: #599bb3;
        border-radius: 18px;
        border: 1px solid #29668f;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 17px;
        padding: 7px 25px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #3d768a;
    }

    .myButton1:hover {
        background: linear-gradient to bottom, #408c99 5%, #599bb3 100%;
        background-color: #408c99;
    }

    .myButton1:active {
        position: relative;
        top: 1px;
    }

    .myButton2 {
        box-shadow: 3px 4px 0px 0px #3e7327;
        background: linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
        background-color: #77b55a;
        border-radius: 18px;
        border: 1px solid #4b8f29;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 17px;
        padding: 7px 25px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #5b8a3c;
    }

    .myButton2:hover {
        background: linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
        background-color: #72b352;
    }

    .myButton2:active {
        position: relative;
        top: 1px;
    }

    .custom {
        box-shadow: 0 5px 5px #6C757D;
    }

</style>
<?php
session_start();
//Report all errors except warnings.
error_reporting(E_ALL ^ E_WARNING);
?>

<head>
    <section class="custom">
        <!-- Refreshes the page every "5" seconds
        <meta http-equiv="refresh" content="5">

         Favicon -->

        <link rel="shortcut icon" href="/Files/Pictures/favicons/home.ico"/>
        <script src="https://kit.fontawesome.com/ec2b6a345c.js"
                crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wdth,wght@82.7,200;131,322&display=swap"
              rel="stylesheet">


        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device  e-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <title>Payslip</title>
        <!-- Navbar Title and other elements-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="javascript:void(0)"
               style="font-family: 'OCR A Std, monospace'; font-size: x-large">
                <h1><b><i>Payslip</i></b></h1></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="Index_boot.php">Home <span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link"
                           style="<?= (isset($_SESSION["name"])) ? ""
                               : "display: none" ?>"
                           href="search.php">Search<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link"
                           style="<?= (isset($_SESSION["name"])) ? ""
                               : "display: none" ?>"
                           href="upload.php">Files<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown"
                        style="position: absolute; right: 0; padding-right: 80px; <?= (!isset($_SESSION["name"]))
                            ? "display: none" : "" ?>">
                        <a class="nav-link dropdown-toggle" href="#"
                           id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <!-- Displays the name and role of logged in admin/user -->
                            <h7><b><?= $_SESSION[('name')]
                                . " </b><i><sup style='font-size: 60%; text-transform: lowercase'>"
                                . $_SESSION[('role')] . "</sup></i>" ?></h7>
                        </a>
                        <div class="dropdown-menu dropdown-menu-center"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="home.php">Home</a>
                            <div class="dropdown-divider"></div>
                            <!-- Changes title of link to MEMBERS.PHP based on role -->
                            <a class="dropdown-item"
                               href="members.php">Manage <?= ($_SESSION['role']
                                    == 'Admin') ? "User / Admins"
                                    : "Account" ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="logout.php">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <!-- Shows/hides login button depending on if admin/user is already logged in -->
                        <a class="nav-link" href="login.php"
                           style="<?= (isset($_SESSION["name"]))
                               ? "display: none"
                               : "" ?>; position: absolute; right: 0; padding-right: 20px;">
                            <h5>Login</h5><span
                                    class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK"
        crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body>