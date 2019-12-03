<?php

require_once "autoload.php";
function StartLoginSession($login, $paswd )
{
    //gebruiker opzoeken ahv zijn login (e-mail)
    $sql = "SELECT * FROM user WHERE usr_email='" . $login . "' ";
    $data = GetData($sql);
    if ( count($data) == 1 )
    {
        $row = $data[0];
        if ($row['usr_admin'] == 0) {
            session_start();
            $_SESSION['message'] = "uw account is nog niet geactiveerd";
            return false;
        }
        //password controleren
        if ( password_verify( $paswd, $row['usr_paswoord'] ))  $login_ok = true;

    }


    if ( $login_ok )
    {
        session_start();
        $_SESSION['usr'] = $row;
        return true;
    }
    $_SESSION['message'] = "uw e-mail of paswoord is niet correct";
    return false;
}




