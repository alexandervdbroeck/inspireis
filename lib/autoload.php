<?php
session_start();
include_once "database.php";
//include_once "volg.php";
include_once "view_functions.php";
include_once "authoristation.php";
include_once "user_log.php";
include_once "sqlstatements.php";
require_once "comment.php";
require_once "blog-detail.php";
require_once "tegel_home.php";
require_once "ontdek_functies.php";
//
//// niet ingelogde gebruikers worden doorverwezen naar de login pagina
if ( ! isset($_SESSION['usr']) AND ! $login_acces AND ! $register_acces )
{
    header("Location: login.php");
}