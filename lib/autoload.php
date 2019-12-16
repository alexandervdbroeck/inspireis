<?php
session_start();

// tijd dat er geen actie geweest is
$inactive = 600;

if(isset($_SESSION['timeout']) ) {
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    { session_destroy();
    include_once "user_log.php";
    LogoutUser();
    header("Location: ../login.php"); }
}
$_SESSION['timeout'] = time();

include_once "database.php";
include_once "error.php";
include_once "view_functions.php";
include_once "authoristation.php";
include_once "sqlstatements.php";



// niet ingelogde gebruikers worden doorverwezen naar de login pagina

if (!isset($_SESSION['usr']) AND !$login_acces AND ! $register_acces )
{
    header("Location:login.php");
}