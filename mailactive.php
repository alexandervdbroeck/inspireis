<?php
session_start();
$login_acces = true;
include_once "lib/autoload.php";
$hash = $_GET["id"];
$data = ExecuteSQL("UPDATE user
SET usr_admin = 1,
usr_verificatie = 0
WHERE usr_verificatie ='".$hash."'");
$_SESSION['message'] = "uw acount is geactiveerd";
header("location:login.php");



