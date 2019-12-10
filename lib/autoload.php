<?php
session_start();

require_once "connection.php";
require_once "database.php";
//require_once "volg.php";
require_once "view_functions.php";
require_once "authoristation.php";
require_once "user_log.php";
require_once "sqlstatements.php";
require_once "comment.php";
require_once "blog-detail.php";
require_once "tegel_home.php";
require_once "ontdek_functies.php";
require_once "ontdekform.php";


//
//// niet ingelogde gebruikers worden doorverwezen naar de login pagina
if ( !isset($_SESSION['usr']) AND !$login_acces AND ! $register_acces )
{
    header("Location: login.php");
}