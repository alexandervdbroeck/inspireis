<?php
$formname = $_POST["formname"];

if ($formname == "logout"){
    session_start();
    session_destroy();
    unset($_SESSION);
    session_start();
    session_regenerate_id();
    $_SESSION["message"] = "U bent afgemeld!";
    header("Location: ../login.php");
}