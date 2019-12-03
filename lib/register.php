<?php

require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$pkey = $_POST["pkey"];
unset($_SESSION['message']);
if ($formname == "registration_form" AND $_POST['registerbutton'] == "Register") {
    //controle of gebruiker al bestaat
    $sql = "SELECT * FROM user WHERE usr_email='" . $_POST['usr_email'] . "' ";
    $data = GetData($sql);
    if (count($data) > 0) {

        $_SESSION["message"] = "Dit e-mailadres is al in gebruik.<br> ";
    }

    //controle wachtwoord minimaal 8 tekens
    if (strlen($_POST["usr_paswoord"]) < 8){
        $_SESSION["message"] .= "Het paswoord moet minsens 8 karakters lang zijn. <br>";

    }

    //controle geldig e-mailadres
    if (!filter_var($_POST["usr_email"],FILTER_VALIDATE_EMAIL)){
        $_SESSION["message"] .= "Dit e-mailadres is niet geldig<br> ";

    }

    if (!isset($_SESSION["message"])){
        //wachtwoord coderen
        $password_encrypted = password_hash($_POST["usr_paswoord"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO $tablename SET " .
            " usr_voornaam='" . htmlentities($_POST['usr_voornaam'], ENT_QUOTES) . "' , " .
            " usr_naam='" . htmlentities($_POST['usr_naam'], ENT_QUOTES) . "' , " .
            " usr_email='" . $_POST['usr_email'] . "' , " .
            " usr_paswoord='" . $password_encrypted . "' ";




        if (ExecuteSQL($sql)) {
            $_SESSION["msg"]= "Bedankt voor uw registratie!";
            if (StartLoginSession($_POST["usr_email"], $_POST["usr_paswoord"])){
                header("Location:../index.php");
            }
        } else {
            $_SESSION["message"] = "Sorry, er liep iets fout. Uw gegevens werden niet goed opgeslagen";
            header("Location: ../register.php");
        }
    } else {
        header("Location: ../register.php");
    } }

