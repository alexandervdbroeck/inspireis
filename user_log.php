<?php
$login_acces = true;
include_once "lib/autoload.php";

PrintPageSection("head");
PrintPageSection("nav_login");
$test = PrintUserLog(15);

echo $test;
?>
