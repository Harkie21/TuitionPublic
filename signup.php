<?php

include "db_login.php";
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
        width: 100%;
        font-size: 20px;
    }

    /* This hover tags allows the switching between "button1" and "button2" */
    .button2:hover {
        background-color: #008CBA;
        color: white;
        border-radius: 4px;
        width: 100%;
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
        width: 100%;
    }

</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<?php
$not_valid = false;
?>
<!-- Signup form -->
<div class=" container d-flex justify-content-center align-items-center"
     style="min-height: 100vh; padding-top: 1.5rem;">
    <form class="border shadow p-3 rounded"
          action="Login/check_signup.php"
          id="form"
          method="post"
          autocomplete="off"
          style="width: 450px;"
          onsubmit="return process(event)">
        <h1 class="text-center p-3">SIGN-UP</h1>
        <!-- Shows the errors after submission, if any -->
        <?php
        if ($_SESSION["not_valid"] ?? false) { ?>
            <div class="alert alert-danger" role="alert" style="font-size: 16px">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                     aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <?= "&nbsp&nbsp&nbsp&nbsp&nbsp" . $_SESSION["not_valid"] ?>
            </div>
            <?php
        } ?>
        <div class="mb-3">
            <label for="name"
                   class="form-label">Name:</label>
            <input type="text"
                   class="form-control"
                   name="name"
                   id="name"
                   pattern="^[A-Za-z]+$"
                   title="Please only use letters"
                   value="<?php
                   if (isset($_SESSION["not_valid"])) {
                       if ($not_valid !== $_SESSION["not_valid"]) {
                           if (isset($_SESSION["tempname"])) {
                               echo htmlentities($_SESSION['tempname']);
                           } else {
                               echo "";
                           }
                       }
                   } ?>"
                   autofocus>
        </div>
        <div class="mb-3">
            <label for="login_id"
                   class="form-label">Username:</label>
            <input type="text"
                   class="form-control"
                   name="login_id"
                   id="login_id"
                   value="<?php
                   if (isset($_SESSION["not_valid"])) {
                       if ($not_valid !== $_SESSION["not_valid"]) {
                           if (isset($_SESSION["tempreglogin"])) {
                               echo htmlentities($_SESSION['tempreglogin']);
                           } else {
                               echo "";
                           }
                       }
                   } ?>">
        </div>
        <div class="mb-3">
            <label for="email"
                   class="form-label">Email:</label>
            <input type="email"
                   class="form-control"
                   name="email"
                   id="email"
                   value="<?php
                   if (isset($_SESSION["not_valid"])) {
                       if ($not_valid !== $_SESSION["not_valid"]) {
                           if (isset($_SESSION["tempmail"])) {
                               echo htmlentities($_SESSION['tempmail']);
                           } else {
                               echo "";
                           }
                       }
                   } ?>">
        </div>
        <div class="mb-3">
            <label for="phone"
                   class="form-label">Phone:</label><br>
            <input type="tel"
                   class="form-control"
                   name="phone"
                   id="phone"
                   style="width: 158% !important;"
            >
            <input type="tel"
                   class="form-control"
                   name="phone1"
                   id="phone1"
                   hidden>
        </div>
        <div class="mb-3">
            <label for="pass"
                   class="form-label">Password:</label>
            <input type="password"
                   name="pass"
                   class="form-control"
                   id="pass"
                   pattern="^(?=.*[a-z])(?=.*[A-Z]).{4,32}$"
                   title="Please include atleast one uppercase and lowercase character. Ensure the password is between 4-32 characters">
        </div>
        <div class="mb-3">
            <label for="pass1"
                   class="form-label">Confirm Password:</label>
            <input type="password"
                   name="pass1"
                   class="form-control"
                   id="pass1">
        </div>
        <div class="mb-1" style="display: none">
            <label class="form-label">Select User Type:</label>
        </div>
        <select class="form-select form-select-sm"
                style="width: 100%; display: none"
                name="role"
                aria-label="Default select example">
            <option selected value="User">User</option>
            <option disabled value="Admin">Admin</option>
        </select><br>

        <button class='button button2'
                type='submit'>Submit
        </button>
        <br>
        <a class="special" href="login.php">Back to login</a>
    </form>
</div>
<?php
if (isset($_SESSION["not_valid"])) {
    if ($not_valid == $_SESSION["not_valid"]) {
        echo <<< HTML
        <script>
            $(function () {
                Swal.fire(
                'Registration Successful',
                'Continue to Login',
                'success',
                ).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = "login.php";
                  }
                })            
            });
        </script>
HTML;
    }
    unset($_SESSION["not_valid"]);
}


include_once 'footer.php'; ?>
<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["au", "in", "us"],
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });


    const info = document.getElementById('form');

    function process(event) {

        console.log('I am here');

        const phoneNumber = phoneInput.getNumber();

        document.getElementById('phone1').value = phoneNumber;


        return true;

        //console.log(document.getElementById('phone1').value);
    }


</script>
