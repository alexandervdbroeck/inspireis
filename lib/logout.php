<?php
require_once "autoload.php";
include_once "user_log.php";
$formname = $_POST["formname"];

if ($formname == "logout"){
    session_start();
    // de log uit beweging van de gebruiker registreren
    LogoutUser();
    session_destroy();
    unset($_SESSION);
    session_start();
    session_regenerate_id();
    $_SESSION["message"] = "U bent afgemeld!";
    header("Location: ../login.php");
}