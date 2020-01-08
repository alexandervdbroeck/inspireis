<?php
session_start();


//$_application_folder = "/wdev_alexander/inspireis/";
$_application_folder = "/inspireis/";


include_once "database.php";
include_once "error.php";
include_once "view_functions.php";
include_once "authoristation.php";
include_once "sqlstatements.php";



// niet ingelogde gebruikers worden doorverwezen naar de login pagina

if (!isset($_SESSION['usr']) AND !$login_acces AND ! $register_acces )
{
    $_SESSION['message'] = "U moet eerst in loggen";
    header("Location:login.php");
    die;
}
