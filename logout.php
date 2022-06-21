<?php

session_start();
// Destroys the session and all vars, etc
session_unset();
session_destroy();

header("Location: login.php");