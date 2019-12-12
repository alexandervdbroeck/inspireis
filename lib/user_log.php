<?php

require_once "autoload.php";

function LoginUser(){
    $session = session_id();
    $usrid = $_SESSION['usr']['usr_id'];
    $timenow = new DateTime( 'NOW', new DateTimeZone('Europe/Brussels') );
    $now = $timenow->format('Y-m-d H:i:s') ;
    $sql = "INSERT INTO logging SET log_usr_id=".$usrid.", log_session_id='".$session."', log_in= '".$now."'";
    ExecuteSQL($sql);
}

function LogoutUser(){
    $session = session_id();
    $timenow = new DateTime( 'NOW', new DateTimeZone('Europe/Brussels') );
    $now = $timenow->format('Y-m-d H:i:s') ;
    $sql = "UPDATE logging SET  log_out='".$now."' where log_session_id='".$session."'";
    ExecuteSQL($sql);
}

