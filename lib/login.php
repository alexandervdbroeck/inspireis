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
        header("Location: ".$_application_folder."index.php");
    }
    else
    {
        $_SESSION["message"] = "Verkeerde login of paswoord";
        header("Location: ".$_application_folder."login.php");
    }
}

else
{
    $_SESSION["message"] = "Foute formname of buttonvalue";
    header("Location:".$_application_folder."login.php");
}
?>