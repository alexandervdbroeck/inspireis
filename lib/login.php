<?php
$login_form = true;
require_once "autoload.php";

$formname = $_POST["formname"];
$buttonvalue = $_POST['loginbutton'];

if ( $formname == "login_form" AND $buttonvalue == "Log in" )
{
    if ( StartLoginSession( $_POST['usr_email'], $_POST['usr_paswoord'] ) )
    {
        $_SESSION["message"]= "Welkom, " . $_SESSION['usr']['usr_voornaam'] . "!" ;
        header("Location: ../index.php");
    }
    else
    {
        header("Location: ../login.php");
    }
}
else
{
    $_SESSION["message"] = "Foute formname of buttonvalue";
}
?>