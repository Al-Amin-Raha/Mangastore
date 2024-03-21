<?php
session_start();
session_unset();
session_destroy();

if (!$_SESSION['loggedin']) {
    header("location: login.php");
}
