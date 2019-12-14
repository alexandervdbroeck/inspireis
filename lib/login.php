<?php
$login_acces = true;
require_once "autoload.php";


$formname = $_POST["formname"];
$buttonvalue = $_POST['loginbutton'];

/* controle of het juiste formulier ingezonden is */
if ( $formname == "login_form" AND $buttonvalue == "Log in" )
{   /* controle van de user zijn gegevens*/
    if ( StartLoginSession( $_POST['usr_login'], $_POST['usr_paswoord'] ) )
    {
        $_SESSION["message"]= "Welkom, " . $_SESSION['usr']['usr_voornaam'] . "!" ;
        header("Location: ../index.php");
    }
    else
    {
        $_SESSION["message"] = "verkeerde user log in of paswoord";
        header("Location: ../login.php");
    }
}
else
{
    $_SESSION["message"] = "Foute formname of buttonvalue";
    header("Location: ../login.php");
}
?>