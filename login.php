<?php

include_once "header.php";
?>
    <style>

        /* This is styling for the submit button */
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }

        /* This a secondary button with a different colour */
        .button2 {
            background-color: white;
            color: #008CBA;
            border: 2px solid #008CBA;
            border-radius: 4px;
            width: 100%
        }

        /* This hover tags allows the switching between "button1" and "button2" */
        .button2:hover {
            background-color: #008CBA;
            color: white;
            border-radius: 4px;
            width: 100%
        }

        a:link.special, a:visited.special {
            background-color: white;
            width: 100%;
            border: 2px solid #008CBA;
            border-radius: 4px;
            color: #008CBA;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }

        a:hover.special, a:active.special {
            background-color: #008CBA;
            color: white;
            border: 2px solid #008CBA;
            border-radius: 4px;
            width: 100%
        }

    </style>

<?php
// Checks if user/admin is logged in
if ( ! isset($_SESSION['login_id']) && ! isset($_SESSION['id'])) {?>


    <div class="container d-flex justify-content-center align-items-center"
         style="min-height: 100vh">
        <form class="border shadow p-3 rounded"
              action="Login/check_login.php"
              method="post"
              style="width: 450px;">
            <h1 class="text-center p-3">LOGIN</h1>
            <!-- Displays error messages (if any) -->
            <?php
            if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <?= "&nbsp&nbsp&nbsp&nbsp&nbsp" . $_GET['error'] ?>
                </div>
                <?php
            } ?>
            <div class="mb-3">
                <label for="login_id"
                       class="form-label">Username:</label>
                <input type="text"  
                       class="form-control"
                       name="login_id"
                       id="login_id"
                       value="<?php if(isset($_GET['error'])) {  echo htmlentities($_SESSION['templogin_id']);}?>"
                       autofocus>
            </div>
            <div class="mb-3">
                <label for="pass"
                       class="form-label">Password:</label>
                <input type="password"
                       name="pass"
                       class="form-control"
                       id="pass">
            </div>
            <button class='button button2'
                    type='submit'>Submit
            </button>
            <br>
            <!-- Option to register -->
            <a class="special" href="signup.php">Click here to register</a>
        </form>
    </div>

    <?php
}
else {
    header("Location: home.php");
} ?>

<?php
include_once "footer.php"
?>