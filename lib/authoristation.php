<?php
$register_acces = true;
require_once "autoload.php";
function StartLoginSession($login, $paswd )
{
    //gebruiker opzoeken ahv zijn email
    $sql = "SELECT * FROM user WHERE usr_email='" . $login . "' ";
    $data = GetData($sql);
    if ( count($data) == 1 )
    {
        $row = $data[0];
        //password controleren
        if ( password_verify( $paswd, $row['usr_paswoord'] ) ) $login_ok = true;
    }
    // user opzoeken ahv zijn login naam
    $sql = "SELECT * FROM user WHERE usr_login='" . $login . "' ";
    $data = GetData($sql);
    if ( count($data) == 1 )
    {
        $row = $data[0];
        //password controleren
        if ( password_verify( $paswd, $row['usr_paswoord'] ) ) $login_ok = true;
    }

    if ( $login_ok )
    {
        session_start();
        $_SESSION['usr'] = $row;
        return true;
    }

    return false;
}

